<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Discount_CodeCreatedForUser extends Mailable
{
    use Queueable, SerializesModels;

    public $date;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->user = $data['user'];
        $this->date = $data['date'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.Discount_CodeCreatedForUser');
    }
}
