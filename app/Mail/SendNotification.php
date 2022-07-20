<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $student_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $student_name)
    {
        $this->user = $user;
        $this->student_name = $student_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.create_notification')->subject('Journal Created Successfully ['.$this->student_name.']');
    }
}
