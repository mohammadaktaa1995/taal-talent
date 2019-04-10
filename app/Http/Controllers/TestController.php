<?php

namespace App\Http\Controllers;

use App\Exam;

class TestController extends Controller
{
    public function showExams()
    {
        $exams = Exam::all();
        return view('test.view', compact('exams'));
    }

    public function showExamQuestions(Exam $exam)
    {
        $questions = $exam->questions()->get();

        if ($exam->page_type == 'single')
            $page = 'single';
        else
            $page = 'multi-question';

        return view('test.' . $page . '-exam-questions', compact('questions'));
    }
}
