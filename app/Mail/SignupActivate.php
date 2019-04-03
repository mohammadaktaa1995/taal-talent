<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignupActivate extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->from('noreply@zoomaal.com', 'Zoomaal')
            ->subject($this->user->email_verification_code . ' is your Zoomaal verification code')
            ->markdown(
                'emails.email_verification',
                [
                    'verification_code' => $this->user->email_verification_code,
                    'expired_at' => $this->user->email_expired_at,
                ]
            );
    }
}
