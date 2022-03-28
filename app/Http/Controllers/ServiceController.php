<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\ImageUploadRequest;
use App\Models\Area;
use App\Models\Image;
use App\Models\PriceType;
use App\Models\Service;
use App\Models\ServiceAreaAvailablity;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{


    public function __construct()
    {
        $this -> middleware('organization.role:manager');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $num_rows = $request -> input('num_rows', 10);
        $services = Service::where('organization_id', organization_id()) -> sortable('id') -> paginate($num_rows) -> withQueryString() ;
        return view('services.index', compact(
            'services',
            'num_rows'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $price_types = PriceType::get();
        $service_categories = ServiceCategory::get();
        $areas = Area::get();
        return view('services.create', compact(
            'price_types',
            'service_categories',
            'areas'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServiceRequest $request)
    {

        // dd($request -> validated());
        $data = $request -> validated();


        $service = new Service();
        $service -> name = $data['name'];
        $service -> description = $data['description'];
        $service -> price = $data['price'];
        $service -> price_type_id = $data['price_type_id'];
        $service -> service_category_id = $data['service_category_id'];
        $service -> organization_id = Auth::user() -> user_organization_memberships[0] -> organization_id;
        
        $service -> save();


        foreach ($data['area'] as $value) {
            $service_area = new ServiceAreaAvailablity();
            $service_area -> area_id = $value;
            $service_area -> service_id = $service -> id;
            $service_area -> save();
        }


        $fileName = time() . '.' . $request->service_image->extension();
        $path = asset('images') . "/" . $fileName;
        $request->service_image->move(public_path('images'), $fileName);

        $document = new Image();
        $document->image_path = $path;

        $service->images()->save($document);

        return redirect() -> route('services.index') -> with('message', 'Service Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        if (organization_id(true) != $service -> organization_id){
            return redirect() -> route('services.index') -> with('message', 'Unauthorized Action');
        }
        return view('services.show', compact(
            'service'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }

    /**
     * Change profile image for specified service 
     */
    public function changeImage(ImageUploadRequest $request, Service $service) 
    {
        if (organization_id(true) != $service -> organization_id){
            return redirect() -> route('services.index') -> with('message', 'UnAuthorized Action');
        }

        $old_image = $service -> images -> first();
        $old_file_path = public_path('images').'\\'.basename($old_image -> image_path);
        unlink($old_file_path);
        $old_image -> delete();


        
        $fileName = time() . '.' . $request->image->extension();
        $path = asset('images') . "/" . $fileName;
        $request->image->move(public_path('images'), $fileName);

        $document = new Image();
        $document->image_path = $path;

        $service->images()->save($document);
        return redirect() -> route('services.show', ['service' => $service -> id]) -> with('message', 'Image Updated Successfully');

    }

}
