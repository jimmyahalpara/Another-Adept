<?php

namespace App\Http\Controllers;

use App\Models\OrderMember;
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
        // $search_text = $request -> input('search_text', '');

        
        $current_user_organization_id = organization_id();
        $orders = ServiceOrder::whereHas('service', function($query) use ($current_user_organization_id){
            $query -> where('organization_id', $current_user_organization_id); 
        });
        
        // if (!empty($search_text)){
        //     $orders = $orders -> whereHas('user', function($query) use ($search_text){
        //         $query -> Where('users.name', 'LIKE', '%'.$search_text.'%');
        //         $query -> Where('users.email', 'LIKE', '%'.$search_text.'%');

        //     });

        //     $orders = $orders -> whereHas('service', function($query) use ($search_text){
        //         $query -> orWhere('name', 'LIKE', '%'.$search_text.'%');
        //     });
        // }
        $orders = $orders -> sortable('order_state_id') -> simplePaginate($num_rows) -> withQueryString() ;

        

        $members = UserOrganizationMembership::with('user')->where('organization_id', $current_user_organization_id) -> get();
        return view('orders.organization', compact(
            'orders',
            'num_rows',
            'members',
            // 'search_text'
        ));
    }


    public function assign(Request $request)
    {
        $request -> validate([
            'order_id' => ['required', 'numeric'],
            'member_id' => ['required', 'numeric']
        ]);

        $order_member = new OrderMember();
        $order_member -> service_order_id = $request -> order_id;
        $order_member -> user_organization_membership_id = $request -> member_id;
        $order_member -> save();

        $service_order = ServiceOrder::findOrFail($request -> order_id);
        $service_order -> order_state_id = 2;
        $service_order -> save();

        return redirect() -> route('order.organization') -> with('message', 'Order assigned');
    }

    public function view_order_detail_ajax(Request $request)
    {
        $request -> validate([
            'order_id' => ['required', 'numeric']
        ]);

        return ServiceOrder::with(['service', 'user', 'user.area', 'user.area.city']) -> find($request -> order_id);
    }

    
}
