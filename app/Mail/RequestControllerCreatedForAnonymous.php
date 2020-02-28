<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestControllerCreatedForAnonymous extends Mailable
{
    use Queueable, SerializesModels;

    public $user;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->user = $data[0];
    }

    /**
     * Build the message.
     *
     */
    public function build()
    {
        return $this->markdown('mail.RequestControllerForAnonymous');
    }
}
