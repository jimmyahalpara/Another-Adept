<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Organization;
use App\Models\PriceType;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {       
        $num_rows = $request->input('num_rows', 10);
        $services = Service::where('organization_id', organization_id())->sortable('id')->simplePaginate($num_rows)->withQueryString();

        $search_text = $request -> input('search_text', '');
        $areas = $request -> input('areas', [Auth::user() -> area_id]);
        $categories_filter = $request -> input('categories_filter', []);
        $price_types_filter = $request -> input('price_types_filter', []);
        $organization_filter = $request -> input('organization_filter', []);
        $min_price = $request -> input('min_price', '');
        $max_price = $request -> input('max_price', '');
        


        $cities = City::orderBy('name') -> get();
        $categories = ServiceCategory::orderBy('name') -> get();
        $price_types = PriceType::orderBy('name') -> get();
        $user = Auth::user();
        $organizations = Organization::orderBy('name') -> get();
        return view('search.index', compact(
            'user',
            'services',
            'num_rows',
            'cities',
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
}
