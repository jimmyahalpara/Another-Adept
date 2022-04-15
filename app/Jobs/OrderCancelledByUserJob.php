<?php

namespace App\Jobs;

use App\Models\UserOrganizationMembership;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderCancelledByUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = $this->details['order'];


        $admins = UserOrganizationMembership::select('*')->leftjoin('user_organization_membership_roles', 'user_organization_memberships.id', 'user_organization_membership_id')->where('organization_id', $order->service->organization_id)->where(function ($q) {
            $q->orWhere('role_id', 1)
                ->orWhere('role_id', 2);
        })->leftjoin('users', 'user_id', 'users.id')->get();

        foreach ($admins as $admin) {
            $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
            $beautymail->send('mails.order_cancelled_by_user', ['order' => $order], function ($message) use ($admin) {
                $message
                    ->from('noreply.serviceadept.me@gmail.com', 'Service Adept Help Desk')
                    ->to($admin->email, $admin->name)
                    ->subject('Order Cancelled By User');
            });
        }


        $user = $order->order_member->user_organization_membership->user;
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('mails.order_cancelled_by_user', ['order' => $order], function ($message) use ($user) {
            $message
                ->from('noreply.serviceadept.me@gmail.com', 'Service Adept Help Desk')
                ->to($user->email, $user->name)
                ->subject('Order Cancelled By User');
        });
    }
}
