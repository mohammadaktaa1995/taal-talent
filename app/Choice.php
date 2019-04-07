<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends \Eloquent
{
    protected $fillable=['text','question_id','is_correct'];
}
