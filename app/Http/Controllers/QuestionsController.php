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
        return response()->json(['success', 'url' => route('exams.show', [\request()->get('exam')])], 200);
    }

    public function updateQuestion(Question $question, Request $request)
    {
        $question->update($request->input());
        $question->choices()->detach();

        if ($request->get('choice_text') != null) {
            $choice = Choice::create(['text' => $request->get('choice_text')]);
            $question->choices()->sync([$choice->id => ['is_correct' => 1]]);
        }
        if ($request->get('between_choice_text') != null) {
            $choice = Choice::create(['text' => $request->get('between_choice_text')]);
            $question->choices()->sync([$choice->id => ['is_correct' => 1]]);
        } else {
            $choices = explode(',', $request->get('choices'));
            foreach ($choices as $choice) {
                if ($request->get('choices_text')[0] == $choice && $choice) {
                    $ch = Choice::create(['text' => $choice]);
                    $question->choices()->attach([$ch->id => ['is_correct' => 1]]);
                } elseif ($choice != null) {
                    $ch = Choice::create(['text' => $choice]);
                    $question->choices()->attach([$ch->id => ['is_correct' => 0]]);
                }
            }
        }
        return response()->json(['success', 'url' => route('exams.show', [$request->get('exam_id')])], 201);
    }
}
