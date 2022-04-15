<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderPlacedJob implements ShouldQueue
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
        $order = $this -> details['order'];
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('mails.order_placed', $this -> details , function ($message) use ($order) {
            $message
                ->from('noreply.serviceadept.me@gmail.com', 'Service Adept Help Desk')
                ->to($order -> user -> email, $order -> user -> name)
                ->subject('New Order Placed');
        });
    }
}
