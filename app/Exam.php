<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Exam
 * @package App
 * @property string $total_points
 * @property string $total_time
 */

class Exam extends \Eloquent
{
    protected $with = ['questions'];
    protected $fillable = ['text', 'description', 'date', 'page_type', 'subject_id'];
    protected $appends = ['total_points','total_time'];

    public function questions()
    {
        return self::belongsToMany(Question::class, 'exams_questions', 'exam_id', 'question_id');
    }

    public function subject()
    {
        return self::belongsTo(Subject::class, 'subject_id');
    }

    public function getTotalPointsAttribute()
    {
        return $this->questions()->sum('point');
    }

    public function getTotalTimeAttribute()
    {
        return $this->questions()->sum('time');
    }


}
