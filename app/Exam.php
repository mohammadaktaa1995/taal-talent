<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends \Eloquent
{
    protected $with=['questions'];
    protected $fillable=['text','description','date','page_type','subject_id'];

    public function questions()
    {
        return self::belongsToMany(Question::class,'exams_questions','exam_id','question_id');
    }

    public function subject()
    {
        return self::belongsTo(Subject::class,'subject_id');
    }

}
