<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\Organization;
use App\Models\PriceType;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\UserServiceRating;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $num_rows = $request->input('num_rows', 10);


        $search_text = $request->input('search_text', '');


        $areas = $request->input('areas', []);
        $categories_filter = $request->input('categories_filter', []);
        $price_types_filter = $request->input('price_types_filter', []);
        $organization_filter = $request->input('organization_filter', []);
        $min_price = $request->input('min_price', '');
        $max_price = $request->input('max_price', '');
        $city_filter = $request->input('city_filter', '');
        $area_filter = $request->input('area_filter', '');
        $state_filter = $request->input('state_filter', '');

        $categories_filter = (is_array($categories_filter)) ? $categories_filter : [];
        $price_types_filter = (is_array($price_types_filter)) ? $price_types_filter : [];
        $organization_filter = (is_array($organization_filter)) ? $organization_filter : [];


        if ($areas != []) {
            $one_area = $areas[0];

            $tmp_area = Area::where('id', $one_area)->first();
            $city_filter = $tmp_area->city_id;
            $state_filter = $tmp_area->city->state;
        }




        // DB::enableQueryLog();
        $services = Service::select('*');


        if ($areas != []) {
            $services = $services->whereHas('areas', function ($query) use ($areas) {
                $query->whereIn('areas.id', $areas);
            });
        } else {
            // select services from area with city_id equal to city_filter
            if ($city_filter != '') {
                $services = $services->whereHas('areas', function ($query) use ($city_filter) {
                    $query->where('areas.city_id', $city_filter);
                });
            }
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

        // $cities = City::orderBy('name')->get();
        $states = City::select('state')->distinct()->orderBy('state')->get();
        $categories = ServiceCategory::orderBy('name')->get();
        $price_types = PriceType::orderBy('name')->get();
        $user = Auth::user();
        $organizations = Organization::orderBy('name')->get();
        return view('search.index', compact(
            'user',
            'services',
            'num_rows',
            'states',
            'search_text',
            'areas',
            'categories_filter',
            'categories',
            'price_types_filter',
            'price_types',
            'min_price',
            'max_price',
            'organizations',
            'organization_filter',
            'city_filter',
            'area_filter',
            'state_filter'
        ));
    }


    public function show(Service $service)
    {
        $user = Auth::user();
        $current_user_rating = null;
        if ($user) {
            $current_user_rating = $service->user_service_ratings->where('user_id', $user->id)->first();
        }

        $service_stat = null;
        if ($service->user_service_ratings_stat()) {
            $service_stat = $service->user_service_ratings_stat();
        }


        return view('search.show', compact(
            'service',
            'user',
            'current_user_rating',
            'service_stat'
        ));
    }


    public function serviceAreasAjax(Request $request, Service $service)
    {
        try {
            $req_start = $request->input('start', 1);
            $req_length = $request->input('length', 10); //number of records a table can display in current draw
            $search_text = $request->input('search', ['value' => ''])['value'];
            $orders = $request->input('order', []);


            $records_total = $service->areas()->count();

            $areas = $service->areas() -> select('areas.name as aname', 'cities.name as cname') -> join('cities', 'areas.city_id', 'cities.id');
            // return $areas -> get();
            if (!empty($search_text)) {
                $areas = $areas->where(function ($q) use ($search_text) {
                    $q->orWhere('areas.name', 'like', '%' . $search_text . '%')
                        ->orWhere('cities.name', 'like', '%' . $search_text . '%');
                });
            }

            $records_filtered = $areas->count();

            foreach ($orders as $order) {
                if ($order['column'] == 'cname' || $order['column'] == '0') {

                    $areas->orderBy('cname', $order['dir']);
                    $areas->orderBy('aname', $order['dir']);
                } else if ($order['column'] == 'aname' || $order['column'] == '1') {
                    $areas->orderBy('aname', $order['dir']);
                    $areas -> orderBy('cname', $order['dir']);
                }
            }



            $areas = $areas->skip($req_start)->take($req_length)->get();
            return [
                'draw' => $request->input('draw', 1),
                'data' => $areas,
                'recordsTotal' => $records_total,
                'recordsFiltered' => $records_filtered,
            ];
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
