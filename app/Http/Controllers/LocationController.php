<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Methods of location controller are used anywhere areas and cities 
 * selection is required, like registration, filtering, etc.
 */
class LocationController extends Controller
{
    /**
     * Get all cities for a state. It takes in a compulsory state body parameter
     * and returns all the cities for that  state.
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Get all areas from a city/district. It takes a compulsory city_id body parameter.
     * It returns all the areas from that city
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
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
