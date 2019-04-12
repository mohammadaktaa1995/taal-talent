<?php

namespace App;


class StudentAnswer extends \Eloquent
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'exam_id', 'question_id', 'text', 'date_of_answer', 'is_true', 'correct_answer_text', 'points'];

    public function Exam()
    {
        return self::belongsTo(Exam::class, 'exam_id');
    }

    public function question()
    {
        return self::belongsTo(Question::class, 'question_id');
    }

    public function user()
    {
        return self::belongsTo(User::class, 'user_id');
    }



}
