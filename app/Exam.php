<?php

namespace App;

use Eloquent;

/**
 * Class Exam
 * @package App
 * @property string $total_points
 * @property string $total_time
 */
class Exam extends Eloquent
{
    protected $with = ['questions'];
    protected $fillable = ['text', 'description', 'date', 'page_type', 'subject_id'];
    protected $appends = ['total_points', 'total_time','converted_total_time'];

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

    public function getConvertedTotalTimeAttribute()
    {
        return $this->minutes($this->total_time);
    }

    public function minutes($seconds)
    {
        return sprintf("%02.2d:%02.2d", floor($seconds / 60), $seconds % 60);
    }

}
