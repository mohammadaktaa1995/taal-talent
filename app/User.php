<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "user";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function answers()
    {
        return self::hasMany(StudentAnswer::class, 'user_id');
    }

    public function getMarkByExamByUser($exam, $user)
    {
        return $this->answers()->where([
            'user_id' => $user,
            'exam_id' => $exam,
            'is_true' => 1
        ])->sum('points');
    }
}
