<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $password_reset;

    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password_reset,$url)
    {
        $this->password_reset = $password_reset;

        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.ForgotPassword');
    }
}
