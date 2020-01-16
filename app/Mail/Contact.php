<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $contact;
    public $email;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        if(isset($data['user'])){
            $this->user = $data['user'];
        }
        if(isset($data['email'])){
            $this->email = $data['email'];
        }
        $this->contact = $data['contact'];
    }

    /**
     * Build the message.
     *
     */
    public function build()
    {
    }
}
