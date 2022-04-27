<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\ThreadReply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // latest Users thread 
        $threads = Thread::where('user_id', Auth::id())->get() -> sortByDesc(function($useritem, $key){
            if ($useritem -> thread_replies() -> latest() -> first()){
                return $useritem -> thread_replies() -> latest() -> first() -> created_at;
            } else {
                return Carbon::now();
            }
        });
        return view('threads.index', compact(
            'threads'
        ));
    }

    public function threads_index_admin(){
        $threads = Thread::all();
        return view('threads.index_admin', compact(
            'threads'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'message' => ['required', 'max:1000'],
        ]);

        $thread = new Thread;
        $thread -> user_id = Auth::id();
        $thread -> message = $request -> message;
        $thread -> save();

        return redirect() -> route('threads.show', ['thread' => $thread -> id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        return view('threads.show', compact(
            'thread'
        ));
    }


    public function reply(Request $request, Thread $thread)
    {
        $request->validate([
            'message' => 'required'
        ]);
        $user_id = Auth::id();

        $reply = new ThreadReply();
        $reply->thread_id = $thread->id;
        $reply->user_id = $user_id;
        $reply->message = request('message');
        $reply->save();


        $user_name = '<span class="text-success">You</span>';
        $message = request('message');
        $time = $reply->created_at->diffForHumans();
        $data_id = $reply->id;
        $response = "<div class=\"chat-message\" data-id=\"$data_id\">
        <div class=\"chat-message-content\" data-id=>
            <div class=\"chat-message-content-header\">
                <div class=\"chat-message-content-header-name\">
                    $user_name
                </div>
                <div class=\"chat-message-content-header-time\">
                    $time
                </div>
            </div>
            <div class=\"chat-message-content-body\">
                $message
            </div>
        </div>
    </div>";
        
        return response()->json([
            'response' => $response
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request, Thread $thread)
    {
        $user_id = Auth::id();
        // only if thread is created by the current user 
        if ($thread -> user_id == Auth::id()) {
            $replies = $thread->thread_replies()->where('id','>', $request -> input('last_data_id', 0)) -> get();
            $response = '';
            foreach ($replies as $reply) {
                if ($user_id == $reply->user -> id) {
                    // $user_name = '<span class="text-success">' . Auth::user()->name . '</span>';
                    $user_name = '<span class="text-success">You</span>';
                } else {
                    $user_name = $reply->user->name ;
                }
                $message = $reply->message;
                $time = $reply->created_at->diffForHumans();
                $data_id = $reply -> id;
                $response .= "<div class=\"chat-message\" data-id=\"$data_id\">
                <div class=\"chat-message-content\">
                    <div class=\"chat-message-content-header\">
                        <div class=\"chat-message-content-header-name\">
                            $user_name
                        </div>
                        <div class=\"chat-message-content-header-time\">
                            $time
                        </div>
                    </div>
                    <div class=\"chat-message-content-body\">
                        $message
                    </div>
                </div>
            </div>";
            }
            return response()->json([
                'response' => $response
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
