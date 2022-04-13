<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $user_name)
    {
        $this -> user_name = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thanks for Joining.') -> view('mails.welcome', ['user_name' => $this -> user_name]);
    }
}
