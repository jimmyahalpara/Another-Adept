<?php

namespace App\Http\Controllers;

use App\Models\OrderMember;
use App\Models\Reason;
use App\Models\Service;
use App\Models\ServiceOrder;
use App\Models\UserOrganizationMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    function __construct()
    {
        $this -> middleware('organization.role:manager', ['except' => ['order', 'order_confirm', 'my_orders']]);
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

        $service_order = ServiceOrder::findOrFail($request -> order_id);
        if ($service_order -> order_state_id != 1 && $service_order -> order_state_id != 2){
            return redirect() ->route('order.organization') -> with('message', 'Cannot assign members to any order which is Cancelled/Rejected/On Hold/Completed. Contact Help Center for Help');
        }
        $service_order -> order_state_id = 2;
        $service_order -> save();


        $order_member = OrderMember::firstOrCreate(
            [
                'service_order_id' => $request -> order_id,
            ],
            [
                'user_organization_membership_id' => $request -> member_id
            ]
        );
        // $order_member -> service_order_id = $request -> order_id;
        $order_member -> user_organization_membership_id = $request -> member_id;
        $order_member -> save();

        

        return redirect() -> route('order.organization') -> with('message', 'Order assigned');
    }

    public function view_order_detail_ajax(Request $request)
    {
        $request -> validate([
            'order_id' => ['required', 'numeric']
        ]);

        return ServiceOrder::with(['service', 'user', 'user.area', 'user.area.city']) -> find($request -> order_id);
    }

    public function cancel_order(Request $request)
    {
        $request -> validate([
            'order_id' => ['required', 'numeric'],
            'reason' => ['required', 'max:100']
        ]);

        $service_order = ServiceOrder::findOrFail($request -> order_id);
        if ($service_order -> order_state_id != 2 && $service_order -> order_state_id != 1){
            return redirect() -> route('order.organization') -> with('message', 'Can Only Cancel Order which was placed or assigned');
        }

        if ($service_order -> order_member){
            $service_order -> order_member -> delete();
        }


        $service_order -> order_state_id = 3;
        $service_order -> save();


        $reason = new Reason();
        $reason -> body = "Cancelled: " .  $request -> reason;
        
        $service_order -> reasons() -> save($reason);

        return redirect() -> route('order.organization') -> with('message', 'Order Cancelled.');

    }

    public function reject_order(Request $request)
    {
        $request -> validate([
            'order_id' => ['required', 'numeric'],
            'reason' => ['required', 'max:100']
        ]);

        $service_order = ServiceOrder::findOrFail($request -> order_id);
        if ($service_order -> order_state_id != 2 && $service_order -> order_state_id != 1){
            return redirect() -> route('order.organization') -> with('message', 'Can Only Reject Order which was placed or assigned');
        }
        // dd($service_order);

        if ($service_order -> order_member){
            $service_order -> order_member -> delete();
        }

        $service_order -> order_state_id = 4;
        $service_order -> save();


        $reason = new Reason();
        $reason -> body = "Rejected: " .  $request -> reason;
        
        $service_order -> reasons() -> save($reason);

        return redirect() -> route('order.organization') -> with('message', 'Order Rejected.');

    }


    public function my_orders(Request $request)
    {
        $user = Auth::user();
        $num_rows = $request -> input('num_rows', 10);

        $member_orders = OrderMember::select('*');
        $member_orders = $member_orders -> whereHas('user_organization_membership', function ($query) use ($user){
            $query -> where('user_id', $user -> id);
        });


        $member_orders = $member_orders -> whereHas('service_order', function($query){
            $query -> where('order_state_id', 2);
        });



        $member_orders = $member_orders -> sortable('order_member_state_id') -> simplePaginate($num_rows);
        return view('orders.orders', compact(
            'member_orders',
            'num_rows'
        ));
    }

    public function change_order_member_state(Request $request){
        
        // dd($request -> all());
        $request -> validate([
            'order_member_id' => ['required', 'numeric'],
            'order_member_state_id' => ['required', 'numeric']
        ]);

        $order_member = OrderMember::findOrFail($request -> order_member_id);
        $order_member -> order_member_state_id = $request -> order_member_state_id;
        $order_member -> save();

        return redirect() -> route('order.my.orders') -> with('message', 'State Change Successfully.');
    }

    
}
