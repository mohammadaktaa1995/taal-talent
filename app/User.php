<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'country_id', 'name', 'email', 'password', 'phone',
        'avatar', 'active',
        'email_verification_code', 'email_verified_at', 'email_expired_at',
        'last_logged_in',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_expired_at' => 'datetime',
        'last_logged_in' => 'datetime',
    ];

    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
