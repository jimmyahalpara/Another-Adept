<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function getCities(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }


        $cities = City::where('state', $request -> state) -> orderBy('name') -> get();
        return $cities;
    }

    public function getAreas(Request $request){
        $validator = Validator::make($request->all(), [
            'city_id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        
        $areas = Area::where('city_id', $request -> city_id) -> orderBy('name') -> get();
        return $areas;
    }
}
