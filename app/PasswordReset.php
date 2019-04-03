<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model {

    use Notifiable;

    public $timestamps = false;
    protected $fillable = ['email', 'token', 'created_at'];

}
