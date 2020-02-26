<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Message extends Mailable
{
    use Queueable, SerializesModels;

    public $receiver;
    public $sender;
    public $message;
    public $announce;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->receiver = $data['receiver'];
        $this->sender = $data['sender'];
        $this->message = $data['message'];
        $this->announce = $data['announce'];
    }

    /**
     * Build the message.
     *
     */
    public function build()
    {
    }
}
