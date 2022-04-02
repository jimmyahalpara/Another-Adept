<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\UserServiceRating;
use Illuminate\Http\Request;

class UserRatingController extends Controller
{
    public function index(Request $request)
    {   
        $service_id = $request -> input('service_id', 0);
        return UserServiceRating::with('user') -> where('service_id', $service_id) -> sortable() -> simplePaginate(5);
    }
}
