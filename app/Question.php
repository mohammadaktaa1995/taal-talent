<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends \Eloquent
{
    protected $with = ['type', 'choices'];
    protected $fillable = ['text', 'description', 'time', 'point', 'created_by', 'question_type_id', 'after_answer'];
    protected $appends = ['full_text', 'converted_time', 'success_rate'];

    public function type()
    {
        return self::belongsTo(QuestionType::class, 'question_type_id');
    }

    public function choices()
    {
        return self::belongsToMany(Choice::class, 'questions_choices', 'question_id', 'choice_id')->withPivot('is_correct');
    }

    public function getFullTextAttribute()
    {
        if ($this->type->code == "BETW")
            return $this->text . ' ' . $this->after_answer;

        return $this->text;
    }

    public function getConvertedTimeAttribute()
    {
        return $this->minutes($this->time);
    }

    public function minutes($seconds)
    {
        return sprintf("%02.2d:%02.2d", floor($seconds / 60), $seconds % 60);
    }

    public function studentRate()
    {
        return self::hasMany(StudentAnswer::class, 'question_id');
    }

    public function getSuccessRateAttribute()
    {
        $question = $this->id;

        $student_answers = $this->studentRate()->where([
            'question_id' => $question,
        ])->get()->count();

        if ($student_answers == 0)
            return '0%';

        $student_correct_answers = $this->studentRate()->where([
            'question_id' => $question,
            'is_true' => 1
        ])->get()->count();


        return ((float)round($student_correct_answers / $student_answers * 100, 1)) . '%';
    }

}
