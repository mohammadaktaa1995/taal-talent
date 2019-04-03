<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetRequest extends Notification implements ShouldQueue
{
    use Queueable;

    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('noreply@zoomaal.com', 'Zoomaal')
            ->subject('Reset your Zoomaal password')
            ->markdown('emails.password_reset_request', [
                'email' => $notifiable->email,
                'reset_code' => $notifiable->token]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
