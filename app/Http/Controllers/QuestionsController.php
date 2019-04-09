<?php

namespace App\Http\Controllers;

use App\Choice;
use App\Exam;
use App\Question;
use App\QuestionType;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function showAddForm()
    {
        $questionTypes = QuestionType::all();
        return view('add-questions', compact('questionTypes'));
    }

    public function deleteQuestion(Question $question)
    {
        $question->delete();
        return response()->json(['success', 'url' =>route('exams.show',[\request()->get('exam')])], 200);
    }

    public function updateQuestion(Question $question,Request $request)
    {
        if ($request->get('choice_text') != null)
            Choice::create(['text' => $request->get('choice_text'), 'is_correct' => 1, 'question_id' => $question->id]);
        else {
            $choices = explode(',', $request->get('choices'));
            foreach ($choices as $choice) {
                if ($request->get('valid_answer_text') == $choice && $choice)
                    Choice::create(['text' => $choice, 'is_correct' => 1, 'question_id' => $question->id]);
                elseif ($choice != null)
                    Choice::create(['text' => $choice, 'is_correct' => 0, 'question_id' => $question->id]);
            }
        }
        return response()->json(['success', 'url' => redirect()->back()], 200);
    }
}
