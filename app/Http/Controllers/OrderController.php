<?php

namespace App\Http\Controllers;

use App\Jobs\InvoiceGeneratedUserJob;
use App\Jobs\OrderAssignJob;
use App\Jobs\OrderAssignUserJob;
use App\Jobs\OrderCompleteUserJob;
use App\Jobs\OrderPlacedAdminJob;
use App\Jobs\OrderPlacedJob;
use App\Jobs\OrderStateChangeJob;
use App\Models\Invoice;
use App\Models\OrderMember;
use App\Models\OrderState;
use App\Models\Reason;
use App\Models\Service;
use App\Models\ServiceOrder;
use App\Models\User;
use App\Models\UserOrganizationMembership;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    function __construct()
    {
        $this->middleware(
            'organization.role:manager',
            [
                'except' => [
                    'order',
                    'order_confirm',
                    'my_orders',
                    // for service providers 
                    'change_order_member_state',
                    'complete'
                ]
            ]
        );

        $this->middleware('organization.role:provider', [
            'only' => [
                'change_order_member_state',
                'complete'
            ]
        ]);
    }
    public function order(Request $request, Service $service)
    {

        $user = Auth::user();
        return view('orders.place', compact(
            'service',
            'user'
        ));
    }


    /**
     * Can Be done by normal users. It is used to confirm the order for given user. 
     * Access: all 
     * 
     * @param Request $request
     * @param int $service_id
     * 
     * @return redirect 
     */
    public function order_confirm(Request $request, $service_id)
    {
        $user_id = Auth::id();
        $service_order = new ServiceOrder();
        $service_order->user_id = $user_id;
        $service_order->service_id = $service_id;
        $service_order->comment = $request->input('comment');
        $service_order->save();


        $order = ServiceOrder::find($service_order->id);
        $job = new OrderPlacedJob(['order' => $order]);
        dispatch($job);


        $job = new OrderPlacedAdminJob(['order' => $order]);
        dispatch($job);

        return redirect()->route('home.orders')->with('message', 'Order Placed Successfully. You can view its progress in My Orders section. We will update you about its status.');
    }



    /**
     * Returens view containing orders  for organization id of current user.
     * Access: manager, admin
     * 
     * @param Request $request
     * 
     * @return view orders.organization
     */
    public function view_organization_orders(Request $request)
    {

        $num_rows = $request->input('num_rows', 10);



        $current_user_organization_id = organization_id();
        $orders = ServiceOrder::whereHas('service', function ($query) use ($current_user_organization_id) {
            $query->where('organization_id', $current_user_organization_id);
        });

        $orders = $orders->sortable('order_state_id')->simplePaginate($num_rows)->withQueryString();



        $members = UserOrganizationMembership::with('user')->where('organization_id', $current_user_organization_id)->get();
        return view('orders.organization', compact(
            'orders',
            'num_rows',
            'members',
            // 'search_text'
        ));
    }


    /**
     * Called from orders.organization view, is used to assign orders to organization members. 
     * Entry is created in OrderMember with appropriate attributes. 
     * shows error if organization id of the servcie which is ordered does not match the 
     * organization id of the user currently logged in. This goes for all the functions below. 
     * 
     * @param Request $request 
     * 
     * @return redirect
     */
    public function assign(Request $request)
    {
        $request->validate([
            'order_id' => ['required', 'numeric'],
            'member_id' => ['required', 'numeric']
        ]);

        $service_order = ServiceOrder::findOrFail($request->order_id);

        $current_user_organization_id = organization_id();
        if ($current_user_organization_id != $service_order->service->organization_id) {
            return redirect()->route('order.organization')->with('message', 'Unauthorized action');
        }

        if ($service_order->order_state_id != 1 && $service_order->order_state_id != 2) {
            return redirect()->route('order.organization')->with('message', 'Cannot assign members to any order which is Cancelled/Rejected/On Hold/Completed. Contact Help Center for Help');
        }
        $service_order->order_state_id = 2;
        $service_order->save();


        $order_member = OrderMember::firstOrCreate(
            [
                'service_order_id' => $request->order_id,
            ],
            [
                'user_organization_membership_id' => $request->member_id
            ]
        );
        // $order_member -> service_order_id = $request -> order_id;
        $order_member->user_organization_membership_id = $request->member_id;
        $order_member->save();

        $job = new OrderAssignJob(['order' => $service_order, 'user' => OrderMember::find($order_member->id)->user_organization_membership->user]);
        dispatch($job);


        $job = new OrderAssignUserJob(['order' => ServiceOrder::find($service_order->id), 'user' => $service_order->user]);
        dispatch($job);

        return redirect()->route('order.organization')->with('message', 'Order assigned');
    }


    /**
     * Ajax call which returns all the details about a given order id. All the information related to service, invoices, 
     * invoice state, user who ordered it, user.area and user.area.city is returned as json string.
     * 
     * @param Request $request
     * 
     * @return json
     */
    public function view_order_detail_ajax(Request $request)
    {
        $request->validate([
            'order_id' => ['required', 'numeric']
        ]);

        $service_order = ServiceOrder::with(['service', 'invoices', 'invoices.invoice_state', 'user', 'user.area', 'user.area.city'])->find($request->order_id);
        $current_user_organization_id = organization_id();
        if ($current_user_organization_id != $service_order->service->organization_id) {
            return redirect()->route('order.organization')->with('message', 'Unauthorized action');
        }

        // convert service_order.ivoices.created_at to normal timestamp from carbon
        // convert service_order.ivoices.updated_at to normal timestamp from carbon
        foreach ($service_order->invoices as $invoice) {
            $invoice->created_at = $invoice->created_at->timestamp;
            $invoice->updated_at = $invoice->updated_at->timestamp;
        }

        return $service_order;
    }

    /**
     * Cancel order from Organization Side. Service ordered should be of same organization as the organization 
     * of current user. Order state should be either placed or assigned. It also take a reason as required 
     * parameter which will be stored with action name in Reasons table.
     * 
     * @param Request $request
     * 
     * @return redirect
     */

    public function cancel_order(Request $request)
    {
        $request->validate([
            'order_id' => ['required', 'numeric'],
            'reason' => ['required', 'max:100']
        ]);

        $service_order = ServiceOrder::findOrFail($request->order_id);
        $current_user_organization_id = organization_id();
        if ($current_user_organization_id != $service_order->service->organization_id) {
            return redirect()->route('order.organization')->with('message', 'Unauthorized action');
        }

        if ($service_order->order_state_id != 2 && $service_order->order_state_id != 1) {
            return redirect()->route('order.organization')->with('message', 'Can Only Cancel Order which was placed or assigned');
        }

        if ($service_order->order_member) {
            $service_order->order_member->delete();
        }


        $service_order->order_state_id = 3;
        $service_order->save();

        $job = new OrderStateChangeJob(['order' => $service_order, 'user' => $service_order->user, 'reason' => $request->reason, 'status' => 'Cancelled']);
        dispatch($job);

        $reason = new Reason();
        $reason->body = "Cancelled: " .  $request->reason;

        $service_order->reasons()->save($reason);

        return redirect()->route('order.organization')->with('message', 'Order Cancelled.');
    }


    /**
     * Reject order from Organization Side. Service ordered should be of same organization as the organization 
     * of current user. Order state should be either placed or assigned. It also take a reason as required 
     * parameter which will be stored with action name in Reasons table.
     * 
     * @param Request $request
     * 
     * @return redirect
     */
    public function reject_order(Request $request)
    {
        $request->validate([
            'order_id' => ['required', 'numeric'],
            'reason' => ['required', 'max:100']
        ]);

        $service_order = ServiceOrder::findOrFail($request->order_id);
        $current_user_organization_id = organization_id();
        if ($current_user_organization_id != $service_order->service->organization_id) {
            return redirect()->route('order.organization')->with('message', 'Unauthorized action');
        }
        if ($service_order->order_state_id != 2 && $service_order->order_state_id != 1) {
            return redirect()->route('order.organization')->with('message', 'Can Only Reject Order which was placed or assigned');
        }
        // dd($service_order);

        if ($service_order->order_member) {
            $service_order->order_member->delete();
        }

        $service_order->order_state_id = 4;
        $service_order->save();

        $job = new OrderStateChangeJob(['order' => $service_order, 'user' => $service_order->user, 'reason' => $request->reason, 'status' => 'Rejected']);
        dispatch($job);

        $reason = new Reason();
        $reason->body = "Rejected: " .  $request->reason;

        $service_order->reasons()->save($reason);

        return redirect()->route('order.organization')->with('message', 'Order Rejected.');
    }

    /**
     * List All orders assigned to me. 
     * 
     * @param Request $reqeust
     * 
     * @return view
     */
    public function my_orders(Request $request)
    {
        $user = Auth::user();
        $num_rows = $request->input('num_rows', 10);

        $member_orders = OrderMember::select('*');
        $member_orders = $member_orders->whereHas('user_organization_membership', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });


        $member_orders = $member_orders->whereHas('service_order', function ($query) {
            $query->where('order_state_id', 2);
        });



        $member_orders = $member_orders->sortable('order_member_state_id')->simplePaginate($num_rows);
        return view('orders.orders', compact(
            'member_orders',
            'num_rows'
        ));
    }


    /**
     * Change order_member state from complete to incomplete, or vice versa. Order member should be of same organization as
     * the current user organization .
     * 
     * @param Request $request
     * 
     * @return redirect
     */
    public function change_order_member_state(Request $request)
    {
        $request->validate([
            'order_member_id' => ['required', 'numeric'],
            'order_member_state_id' => ['required', 'numeric']
        ]);

        $order_member = OrderMember::findOrFail($request->order_member_id);


        $current_user_organization_id = organization_id();
        if ($current_user_organization_id != $order_member->service_order->service->organization_id) {
            return redirect()->route('order.my.orders')->with('message', 'Unauthorized action');
        }

        $order_member->order_member_state_id = $request->order_member_state_id;
        $order_member->save();

        return redirect()->route('order.my.orders')->with('message', 'State Change Successfully.');
    }


    /**
     * Toggle order state between assigned to 
     */
    public function complete(Request $request)
    {
        $request->validate([
            'order_state_id' => ['required', 'numeric'],
            'service_order_id' => ['required', 'numeric']
        ]);
        $user_id = Auth::id();
        // $service_order = ServiceOrder::where('id', $request->service_order_id)->first();
        $service_order = ServiceOrder::findOrFail($request->service_order_id);

        $current_user_organization_id = organization_id();
        if ($current_user_organization_id != $service_order->service->organization_id) {
            return redirect()->route('order.organization')->with('message', 'Unauthorized action');
        }
        if ($service_order->order_state_id == 3 || $service_order->orde_state_id == 4 || $service_order->order_state_id == 5) {
            return redirect()->route('order.organization')->with('message', 'Cannot change state of the order which is cancelled/rejected or On Hold.');
        }

        if ($request->order_state_id != 6) {
            if ($service_order->order_member()->count() > 0) {
                $service_order->order_state_id = $request->order_state_id;
            } else {
                $service_order->order_state_id = 1;
            }
        } else {
            $service_order -> order_state_id = $request->order_state_id;
        }
        if ($request->order_state_id == 6) {
            $job = new OrderCompleteUserJob(['order' => $service_order]);
            dispatch($job);
        }
        $service_order->save();
        return redirect()->route('order.organization')->with('message', 'Order State changed');
    }



    public function generate_invoice_form(Request $request, ServiceOrder $service_order)
    {
        if ($service_order->order_state_id != 1 && $service_order->order_state_id != 2) {
            return redirect()->route('order.organization')->with('message', 'Can Only Generate Invoice for Orders whose status is placed or assigned.');
        }

        $current_user_organization_id = organization_id();
        if ($current_user_organization_id != $service_order->service->organization_id) {
            return redirect()->route('order.organization')->with('message', 'Unauthorized action');
        }

        return view('invoice.create', compact(
            'service_order'
        ));
    }


    public function store_invoice(Request $request, ServiceOrder $service_order)
    {
        // dd($request -> all());
        $request->validate([
            'amount' => ['required', 'numeric'],
            'description' => ['max:200']
        ]);

        if ($service_order->order_state_id != 1 && $service_order->order_state_id != 2) {
            return redirect()->route('order.organization')->with('message', 'Can Only Generate Invoice for Orders whose status is placed or assigned.');
        }
        $current_user_organization_id = organization_id();
        if ($current_user_organization_id != $service_order->service->organization_id) {
            return redirect()->route('order.organization')->with('message', 'Unauthorized action');
        }

        $invoice = new Invoice();
        $invoice->user_id = $service_order->user->id;

        $invoice->amount = $request->input('amount', 0);


        $invoice->service_order_id = $service_order->id;
        $invoice->description = $request->input('description', '');
        // set due date to be confif(appconfig.due_days) days from today 
        $invoice->due = Carbon::now()->addDays(config('appconfig.due_days'));
        $invoice->save();


        $job = new InvoiceGeneratedUserJob(['invoice' => Invoice::find($invoice->id)]);
        dispatch($job);


        return redirect()->route('order.organization')->with('message', 'Invoice Generated Successfully');
    }
}
