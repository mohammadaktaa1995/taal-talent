<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignupActivated extends Mailable
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
            ->subject('Hey ' . $this->user->name . '! Thanks for signing up.')
            ->markdown('emails.email_verified');
    }
}
