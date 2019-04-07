<?php

namespace App\Http\Controllers;

use App\Choice;
use App\Exam;
use App\Question;
use App\QuestionType;
use App\Subject;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    public function showAll()
    {
        $exams = Exam::all();
        $subjects = Subject::all();
        return view('exams.view', compact('exams', 'subjects'));
    }

    public function showAddExamQuestion(Exam $exam)
    {
        $questionTypes = QuestionType::all();
        return view('exams.add-show-exam', compact('exam', 'questionTypes'));
    }

    public function add(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'date' => 'required|date|date_format:Y-m-d|after:today',
            'subject_id' => 'required|exists:subjects,id',
            'text' => 'required|string'
        ]);

        Exam::create($request->input());

        return response()->json(['success', 'url' => route('exams')], 200);
    }

    public function addQuestion(Request $request)
    {
        $exam = Exam::find($request->get('exam_id'));
        $question = Question::create($request->input());
        $exam->questions()->attach($question->id);


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
        return response()->json(['success', 'url' => route('exams.show', [$exam->id])], 201);
    }
}
