<?php

namespace App\Http\Controllers;

use App\Models\OrganizationRole;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
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
}
