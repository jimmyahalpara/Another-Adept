<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\ImageUploadRequest;
use App\Jobs\ServiceAvailableJob;
use App\Models\Area;
use App\Models\City;
use App\Models\Image;
use App\Models\PriceType;
use App\Models\Service;
use App\Models\ServiceAreaAvailablity;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\UserServiceLike;
use App\Models\UserServiceRating;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{


    public function __construct()
    {
        $this->middleware('organization.role:manager', ['except' => ['rate', 'serviceLikeUnlike']]);
    }

    /**
     * Display a listing of the services.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $num_rows = $request->input('num_rows', 10);
        $services = Service::where('organization_id', organization_id())->sortable('id')->paginate($num_rows)->withQueryString();
        return view('services.index', compact(
            'services',
            'num_rows',
        ));
    }

    /**
     * Show the form for creating a new service.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $price_types = PriceType::get();
        $service_categories = ServiceCategory::get();
        // $areas = Area::get();
        $states = City::select('state')->distinct()->get();
        return view('services.create', compact(
            'price_types',
            'service_categories',
            'states'
        ));
    }

    /**
     * Store a newly created service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServiceRequest $request)
    {

        // dd($request -> validated());
        $data = $request->validated();


        $service = new Service();
        $service->name = $data['name'];
        $service->description = $data['description'];
        $service->price = $data['price_type_id'] != config('appconfig.variable_pricetype_id') ? $data['price'] : 0;
        $service->price_type_id = $data['price_type_id'];
        $service->service_category_id = $data['service_category_id'];
        $service->organization_id = Auth::user()->user_organization_memberships[0]->organization_id;

        $service->save();


        foreach ($data['area'] as $value) {

            $area = ServiceAreaAvailablity::where('area_id', $value)->where('service_id', $service->id)->get();
            if ($area->count() > 0) {
                continue;
            }
            $service_area = new ServiceAreaAvailablity();
            $service_area->area_id = $value;
            $service_area->service_id = $service->id;
            $service_area->save();
        }


        $fileName = time() . '.' . $request->service_image->extension();
        $path = asset('images') . "/" . $fileName;
        $request->service_image->move(public_path('images'), $fileName);

        $document = new Image();
        $document->image_path = $path;

        $service->images()->save($document);

        return redirect()->route('services.index')->with('message', 'Service Created Successfully');
    }

    /**
     * Display the specified service.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {

        // check if current service has same organiation id as the user making this request.
        if (organization_id(true) != $service->organization_id) {
            return redirect()->route('services.index')->with('message', 'Unauthorized Action');
        }

        $price_types = PriceType::get();
        $service_categories = ServiceCategory::get();

        $states = City::select('state')->distinct()->get();
        return view('services.show', compact(
            'service',
            'price_types',
            'service_categories',
            'states'
        ));
    }


    /**
     * Remove the specified service from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        if (organization_id(true) != $service->organization_id) {
            return redirect()->route('services.index')->with('message', 'UnAuthorized Action');
        }

        $service->delete();
        return redirect()->route('services.index')->with('message', 'Service Deleted Successfully.');
    }

    /**
     * Change profile image for specified service 
     */
    public function changeImage(ImageUploadRequest $request, Service $service)
    {
        if (organization_id(true) != $service->organization_id) {
            return redirect()->route('services.index')->with('message', 'UnAuthorized Action');
        }

        $old_image = $service->images->first();
        $old_file_path = public_path('images') . '\\' . basename($old_image->image_path);
        unlink($old_file_path);
        $old_image->delete();



        $fileName = time() . '.' . $request->image->extension();
        $path = asset('images') . "/" . $fileName;
        $request->image->move(public_path('images'), $fileName);

        $document = new Image();
        $document->image_path = $path;

        $service->images()->save($document);
        return redirect()->route('services.show', ['service' => $service->id])->with('message', 'Image Updated Successfully');
    }


    /**
     * Function to update service name from post request 
     */
    public function updateName(Request $request, Service $service)
    {
        // check if current service has same organiation id as the user making this request.
        if (organization_id(true) != $service->organization_id) {
            return redirect()->route('services.index')->with('message', 'Unauthorized Action');
        }


        $request->validate([
            'name' => ['required', 'max:255', 'min:3']
        ]);

        $service->name = $request->name;
        $service->save();
        return redirect()->route('services.show', ['service' => $service->id])->with('message', 'Name Updated Successfully!');
    }


    /** 
     * Function to update service description from post request 
     */
    public function updateDescription(Request $request, Service $service)
    {
        // check if current service has same organiation id as the user making this request.
        if (organization_id(true) != $service->organization_id) {
            return redirect()->route('services.index')->with('message', 'Unauthorized Action');
        }


        $request->validate([
            'description' => ['required', 'max:5000', 'min:3']
        ]);

        $service->description = $request->description;
        $service->save();
        return redirect()->route('services.show', ['service' => $service->id])->with('message', 'Description Updated Successfully!');
    }

    /**
     * function to update service price 
     */
    public function updatePrice(Request $request, Service $service)
    {
        // check if current service has same organiation id as the user making this request.
        if (organization_id(true) != $service->organization_id) {
            return redirect()->route('services.index')->with('message', 'Unauthorized Action');
        }

        if ($service -> price_type_id == config('appconfig.variable_pricetype_id')){
            return redirect()->route('services.show', ['service' => $service -> id])->with('message', 'Cannot set price of service which has price type variable.');
        }

        $request->validate([
            'price' => ['required', 'numeric'],
        ]);

        $service->price = $request->price;
        $service->save();
        return redirect()->route('services.show', ['service' => $service->id])->with('message', 'Price Updated Successfully!');
    }


    /**
     * Function to update service price type
     */
    public function updatePriceType(Request $request, Service $service)
    {
        // check if current service has same organiation id as the user making this request.
        if (organization_id(true) != $service->organization_id) {
            return redirect()->route('services.index')->with('message', 'Unauthorized Action');
        }


        $request->validate([
            'price_type_id' => ['required', 'numeric'],
        ]);

        $service->price_type_id = $request->price_type_id;
        $service->price = $request->price_type_id == config('appconfig.variable_pricetype_id') ? 0 : $service->price;
        $service->save();
        return redirect()->route('services.show', ['service' => $service->id])->with('message', 'Price Type Updated Successfully!');
    }


    /**
     * function to update service category 
     */
    public function updateServiceCategory(Request $request, Service $service)
    {
        // check if current service has same organiation id as the user making this request.
        if (organization_id(true) != $service->organization_id) {
            return redirect()->route('services.index')->with('message', 'Unauthorized Action');
        }


        $request->validate([
            'service_category_id' => ['required', 'numeric'],
        ]);

        $service->service_category_id = $request->service_category_id;
        $service->save();
        return redirect()->route('services.show', ['service' => $service->id])->with('message', 'Service Category Updated Successfully!');
    }



    /** 
     * Function to update service area. It deletes all the available entry for the service in 
     * service_area_availablity and updatedes it with new recieved data. 
     */
    public function updateArea(Request $request, Service $service)
    {

        // check if current service has same organiation id as the user making this request.
        if (organization_id(true) != $service->organization_id) {
            return redirect()->route('services.index')->with('message', 'Unauthorized Action');
        }

        // dd($request -> all());


        $service_id = $service->id;

        $area_array = $request->area;

        if ($request->has('all_in_city') && $request->all_in_city == 'on') {
            $request->validate([
                'city_id' => ['required', 'numeric']
            ]);
            $area_array = Area::where('city_id', $request->city_id)->pluck('id')->toArray();
        } else {
            $request->validate([
                'area' => ['required'],
                'area.*' => ['required', 'numeric', 'min:1']
            ]);
        }


        $new_array = [];
        foreach ($area_array as $value) {

            // check if service_id and area_id is already in the database.
            $check = ServiceAreaAvailablity::where('service_id', $service_id)
                ->where('area_id', $value)
                ->first();

            if ($check) {
                continue;
            }

            $new_array[] = $value;
            $service_area = new ServiceAreaAvailablity();
            $service_area->area_id = $value;
            $service_area->service_id = $service->id;
            $service_area->save();
        }

        $job = new ServiceAvailableJob([
            'service' => Service::find($service_id),
            'old_areas_ids' => [],
            'new_areas_ids' => $new_array
        ]);
        // dd($job);
        dispatch($job);

        return redirect()->route('services.show', ['service' => $service->id])->with('message', 'Areas Updated Successfully!');
    }

    /**
     * Delete single areas from the service. 
     */
    public function deleteAreaAvailablity(Request $request, Service $service)
    {
        // check if current service has same organiation id as the user making this request.
        if (organization_id(true) != $service->organization_id) {
            return redirect()->route('services.index')->with('message', 'Unauthorized Action');
        }

        $request->validate([
            'area_id' => ['required', 'numeric']
        ]);

        // delete service area
        $service_area = ServiceAreaAvailablity::where('service_id', $service->id)
            ->where('area_id', $request->area_id)
            ->first();

        if ($service_area) {
            $service_area->delete();
        }

        return redirect()->route('services.show', ['service' => $service->id])->with('message', 'Area Deleted Successfully!');
    }

    /**
     * Delete multiple areas from the service. 
     */
    public function massDeleteAreaAvailablity(Request $request, Service $service)
    {
        $request->validate([
            'area_ids' => ['required']
        ]);

        if (organization_id(true) != $service->organization_id) {
            return redirect()->route('services.index')->with('message', 'Unauthorized Action');
        }

        $area_ids = $request->area_ids;
        // split comma seperated array 
        $area_ids = explode(',', $area_ids);

        $service_area = ServiceAreaAvailablity::whereIn('area_id', $area_ids)
            ->where('service_id', $service->id)
            ->delete();

        return redirect()->route('services.show', ['service' => $service->id])->with('message', 'Areas Deleted Successfully!');
    }

    /**
     * Like a service and dislike a service if already liked.
     */
    public function serviceLikeUnlike(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
            'action' => ['required', 'numeric']
        ]);

        $user = Auth::user();
        $service = Service::findOrFail($request->id);

        if ($request->action == '1' && UserServiceLike::where('user_id', $user->id)->where('service_id', $service->id)->count() <= 0) {
            $user_service_like = new UserServiceLike();
            $user_service_like->user_id = $user->id;
            $user_service_like->service_id = $service->id;
            $user_service_like->save();

            return $user->services()->count();
        } else {
            UserServiceLike::where('user_id', $user->id)->where('service_id', $service->id)->delete();
            return $user->services()->count();
        }
    }

    /**
     * Rate a service and update the rating if already rating, and write reviews.
     */
    public function rate(Request $request, Service $service)
    {
        $request->validate([
            'rating' => 'required',
            'feedback' => 'max:1000'
        ]);


        $user_id = Auth::id();

        $user_service_rating = UserServiceRating::firstOrNew([
            'user_id' => $user_id,
            'service_id' => $service->id
        ]);
        $user_service_rating->user_id = $user_id;
        $user_service_rating->service_id = $service->id;
        $user_service_rating->rating = $request->rating;
        $user_service_rating->feedback = $request->input('feedback', null);

        $user_service_rating->save();

        return redirect()->route('search.show', ['service' => $service->id])->with('message', 'Heartly Thanks for your feedback');
    }

    /**
     * MEthod serves datatable ajax request for getting, sorting, searching and paginate 
     * areas. 
     */
    public function getServiceAreaAjax(Request $request, Service $service)
    {
        if (organization_id(true) != $service->organization_id) {
            return ['message'=> 'Unauthorized Action'];
        }
        try {
            $req_start = $request->input('start', 1);
            $req_length = $request->input('length', 10); //number of records a table can display in current draw
            $search_text = $request -> input('search', ['value' => ''])['value'];
            $orders = $request -> input('order', []);
    
    
            $records_total = $service->areas()->count();
            
            $areas = $service->areas() -> join('cities', 'areas.city_id', 'cities.id');
            
            if (!empty($search_text)){
                $areas = $areas -> where(function($q) use ($search_text){
                    $q -> orWhere('areas.name', 'like', '%'.$search_text.'%')
                       -> orWhere('cities.name', 'like', '%'.$search_text.'%');
                });
            }
            
            foreach ($orders as $order) {
                if ($order['column'] == 'area' || $order['column'] == '1'){

                    $areas -> orderBy('cities.name', $order['dir']);
                    $areas -> orderBy('areas.name', $order['dir']);
                }
            }
            
            
            $records_filtered = $areas -> count();
    
            $areas = $areas->skip($req_start)->take($req_length)->get();
            // return DB::getQueryLog();

            $records = [];
            $count = 0;
            foreach ($areas as $area) {
                $records[$count]['checkbox'] = '<input class="form-checkbox area-select-checkbox" type="checkbox" name="select-area-'. $area -> id .'" id="select-area-id-'. $area -> id .'" value="'.$area -> id.'">';
                $records[$count]['area'] = $area->city->name . " - " . $area->name;
                $records[$count]['action'] = '<form onsubmit="return confirm(\'Do you want to remove this area ?\')"
                id="delete-area-form-'.$area -> id.'" action="'. route('services.area.delete', ['service' => $service->id]) .'" method="POST"> '.csrf_field().' <input type="hidden" name="area_id" value="'.$area -> id.'"> </form> <a href="#"
                onclick="$(\'#delete-area-form-'.$area -> id.'\').submit(); return false;"><i class="fa-solid fa-trash text-danger"></i></a>';
                $count++;
            }
            return [
                'draw' => $request->input('draw', 1),
                'data' => $records,
                'recordsTotal' => $records_total,
                'recordsFiltered' => $records_filtered,
            ];
        } catch (Exception $e) {
            return response([
                'message' => $e -> getMessage()
            ], 500);
        }
    }
}
