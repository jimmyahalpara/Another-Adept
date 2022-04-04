<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(Request $request, Service $service)
    {
        
        $user = Auth::user();
        return view('orders.place', compact(
            'service',
            'user'
        ));
    }

    public function order_confirm(Request $request, $service_id)
    {
        $user_id = Auth::id();
        $service_order = new ServiceOrder();
        $service_order -> user_id = $user_id;
        $service_order -> service_id = $service_id;
        $service_order -> comment = $request -> input('comment');
        $service_order -> save();


        return redirect() -> route('home') -> with('message', 'Order Placed Successfully. You can view its progress in My Orders section. We will update you about its status.');
    }

    public function view_organization_orders()
    {
        
    }
}
