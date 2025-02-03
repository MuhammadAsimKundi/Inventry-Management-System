<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class UserNotification extends Notification
{
    use Queueable;

    protected $message;
    protected $userName;

    // Accept both message and userName as parameters
    public function __construct($message, $userName)
    {
        $this->message = $message;
        $this->userName = $userName;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    // Pass userName to the database notification data
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'user_name' => $this->userName,  // Include userName in the notification data
        ];
    }
}
