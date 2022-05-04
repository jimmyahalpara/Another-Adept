<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Jobs\OrderCancelledByUserJob;
use App\Models\Area;
use App\Models\City;
use App\Models\Organization;
use App\Models\OrganizationRole;
use App\Models\PriceType;
use App\Models\Reason;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * This controller is concerned with all the methods that are related to the user
 */
class HomeController extends Controller
{

    /**
     * Show the application dashboard. This method returns homepage 
     * view for the application
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $service_categories = ServiceCategory::get();

        return view('home', compact(
            'service_categories'
        ));
    }

    /**
     * this methods is used to view all the likes posts for the user. 
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view_liked(Request $request)
    {
        $num_rows = $request->input('num_rows', 10);
        $user = Auth::user();

        $search_text = $request->input('search_text', '');


        $areas = $request->input('areas', []);
        $categories_filter = $request->input('categories_filter', []);
        $price_types_filter = $request->input('price_types_filter', []);
        $organization_filter = $request->input('organization_filter', []);
        $min_price = $request->input('min_price', '');
        $max_price = $request->input('max_price', '');

        // DB::enableQueryLog();
        $services = $user->services()->select('*');


        if ($areas != []) {
            $services = $services->whereHas('areas', function ($query) use ($areas) {
                $query->whereIn('areas.id', $areas);
            });
        }

        if ($categories_filter != []) {
            $services = $services->whereIn('service_category_id', $categories_filter);
        }

        if ($organization_filter != []) {
            $services = $services->whereIn('organization_id', $organization_filter);
        }

        if ($price_types_filter != []) {
            $services = $services->whereIn('price_type_id', $price_types_filter);
        }

        if ($min_price != '') {
            $services = $services->where('price', '>=', $min_price);
        }

        if ($max_price != '') {
            $services = $services->where('price', '<=', $max_price);
        }

        $services->where(function ($query) use ($search_text) {
            if ($search_text != '') {

                $search_organization_list = Organization::where('name', 'LIKE', '%' . $search_text . '%')->get()->keyBy('id')->toArray();
                $search_organization_list = array_keys($search_organization_list);
                $search_categories_list = ServiceCategory::select('id')->where('name', 'LIKE', '%' . $search_text . '%')->get()->keyBy('id')->toArray();
                $search_categories_list = array_keys($search_categories_list);


                if ($search_categories_list != []) {
                    $query = $query->orWhereIn('services.service_category_id', $search_categories_list);
                }

                if ($search_organization_list != []) {
                    $query = $query->orWhereIn('services.organization_id', $search_organization_list);
                }

                $query = $query->orWhere('services.name', 'LIKE', '%' . $search_text . '%');
                $query = $query->orWhere('services.description', 'LIKE', '%' . $search_text . '%');
            }
        });




        $services = $services->sortable('id')->simplePaginate($num_rows)->withQueryString();

        $categories = ServiceCategory::orderBy('name')->get();
        $price_types = PriceType::orderBy('name')->get();

        $organizations = Organization::orderBy('name')->get();
        return view('home.cart', compact(
            'user',
            'services',
            'num_rows',
            // 'cities',
            'search_text',
            'areas',
            'categories_filter',
            'categories',
            'price_types_filter',
            'price_types',
            'min_price',
            'max_price',
            'organizations',
            'organization_filter'
        ));
    }

    /**
     * this method is called to view all the services ordered by the user. It also shows status of the order, option 
     * to cancel the order, and if the order is assigned to some provider, then it shows provider's contact details. 
     */
    public function my_orders(Request $request)
    {
        $user = Auth::user();
        $orders = ServiceOrder::where('user_id', $user->id)->sortable(['id' => 'desc'])->simplePaginate(10)->withQueryString();
        return view('home.orders', compact(
            'orders',
            'user'
        ));
    }

    /**
     * this method is called when users cancels the order. It takes in required parameter service_order_id, which should be numeric. 
     * If there is an order with that order id from the current user, then that order will be cancelled, with a message to the admin. 
     * It returns redirect response 
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */

    public function cancel_order(Request $request)
    {
        // dd($request -> all());
        $request->validate([
            'service_order_id' => ['required', 'numeric']
        ]);
        $user_id = Auth::id();
        $service_order = ServiceOrder::where('id', $request->service_order_id)->where('user_id', $user_id)->first();


        $service_order->order_state_id = 3;
        $service_order->save();


        $reason = new Reason();
        $reason->body = "Cancelled: By User";

        $service_order->reasons()->save($reason);

        $job = new OrderCancelledByUserJob(['order' => $service_order]);
        dispatch($job);


        return redirect()->route('home.orders')->with('message', 'Service Cancelled');
    }

    /**
     * This methods returns my profile view which shows the user's profile information, and also adds option
     * to update that information.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view_profile()
    {
        $user = Auth::user();
        $states = City::select('state') -> distinct() -> get();
        $cities = City::where('state', $user->area->city->state) -> get();
        $areas = Area::where('city_id', $user->area->city->id) -> get();
        return view('home.profile', compact(
            'user',
            'states',
            'cities',
            'areas'
        ));
    }


    /**
     * This method is called when user updates his profile. It takes in new parameters, and updates the user's profile.
     * If user updated his email address, then he'll have to reverify that email again. 
     * 
     * @param UserEditRequest $request
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function edit_profile(UserEditRequest $request)
    {
        $message = 'Profile updated successfully.';
        $user = Auth::user();
        $user->name = $request->name;

        if ($user->email != $request->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
            $message .= "You need to verify your email id before doing other things.";
        }
        $user->phone_number - $request->phone_number;
        $user->address = $request->address;
        $user->area_id = $request->area_id;

        $user->save();

        return redirect()->back()->with('message', $message);
    }

    /**
     * This method is used to view team page of the website.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function team(){
        return view('home.team');
    }
}
