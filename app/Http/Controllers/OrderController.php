<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceOrder;
use App\Models\UserOrganizationMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    function __construct()
    {
        $this -> middleware('organization.role:manager', ['except' => ['order', 'order_confirm']]);
    }
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

    public function view_organization_orders(Request $request)
    {

        $num_rows = $request -> input('num_rows', 10);
        
        $current_user_organization_id = organization_id();
        $orders = ServiceOrder::whereHas('service', function($query) use ($current_user_organization_id){
            $query -> where('organization_id', $current_user_organization_id); 
        }) -> sortable('order_state_id') -> simplePaginate($num_rows) -> withQueryString() ;

        

        $members = UserOrganizationMembership::with('user')->where('organization_id', $current_user_organization_id) -> get();
        return view('orders.organization', compact(
            'orders',
            'num_rows',
            'members'
        ));
    }
}
