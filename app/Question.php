<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends \Eloquent
{
    protected $with = ['type', 'choices'];
    protected $fillable = ['text', 'description', 'time', 'point', 'created_by', 'question_type_id', 'after_answer'];

    public function type()
    {
        return self::belongsTo(QuestionType::class, 'question_type_id');
    }

    public function choices()
    {
        return self::belongsToMany(Choice::class, 'questions_choices','question_id','choice_id')->withPivot('is_correct');
    }

}
