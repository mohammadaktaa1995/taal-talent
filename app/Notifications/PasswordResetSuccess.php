<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetSuccess extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('noreply@zoomaal.com', 'Zoomaal')
            ->subject('Your Zoomaal password has been changed')
            ->markdown('emails.password_reset_success');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
