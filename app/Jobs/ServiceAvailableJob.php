<?php

namespace App\Jobs;

use App\Models\UserServiceLike;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ServiceAvailableJob implements ShouldQueue
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
        $new_area_ids = $this->details['new_areas_ids'];
        $old_area_ids = $this->details['old_areas_ids'];

        $difference = array_diff($new_area_ids, $old_area_ids);


        $service = $this->details['service'];
        $user_service_like = UserServiceLike::where('service_id', '=', $service->id)->get();


        foreach ($user_service_like as $like) {
            $user_area_id = $like->user->area_id;

            $user = $like->user;
            $this -> details['user'] = $user;
            if (in_array($user_area_id, $difference)) {
                $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);

                $beautymail->send('mails.service_available', $this -> details, function ($message) use ($user) {
                    $message
                        ->from('noreply.serviceadept.me@gmail.com', 'Service Adept Help Desk')
                        ->to($user -> email, $user -> name)
                        ->subject('Hurry!!');
                });
            }
        }
    }
}
