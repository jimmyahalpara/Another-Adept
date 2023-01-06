<?php

namespace App\Widgets\Admin;

use App\Models\Organization;
use App\Models\OrganizationPayout;
use App\Models\Thread;
use App\Models\ThreadReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;



class UnansweredThreadDimmer extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = Thread::count() -  ThreadReply::select('thread_id') -> distinct() -> get() -> count();
        $string = 'Unanswered Help Threads';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-question',
            'title'  => "{$count} {$string}",
            'text'   => "You have {$count} {$string} ",
            'button' => [
                'text' => 'View Requests',
                // 'link' => route('voyager.threads.index'),
                'link' => '#',
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->hasRole('helper') || Auth::user() -> hasRole('admin');
    }
}
