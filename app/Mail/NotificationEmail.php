<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $notifications;

    public function __construct($notifications)
    {
        $this->notifications = $notifications;
    }

    public function build()
    {
        return $this->view('emails.notifications')
            ->with(['notifications' => $this->notifications]);
    }
}
