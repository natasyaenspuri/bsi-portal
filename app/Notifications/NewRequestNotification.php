<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRequestNotification extends Notification
{
    use Queueable;

    public $requestModel;

    /**
     * Create a new notification instance.
     */
    public function __construct($requestModel)
    {
        $this->requestModel = $requestModel;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'new_request',
            'request_id' => $this->requestModel->id,
            'user_name' => $this->requestModel->user->name ?? 'User', // Handle potential relation load issue if needed
            'message' => 'New request received from ' . ($this->requestModel->user->name ?? 'User'),
        ];
    }
}
