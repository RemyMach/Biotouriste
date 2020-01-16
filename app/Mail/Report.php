<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Report extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $report;
    public $userReported;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->report = $data['report'];
        $this->sender = $data['sender'];
        $this->userReported = $data['UserReported'];
    }

    /**
     * Build the message.
     *
     */
    public function build()
    {
    }
}
