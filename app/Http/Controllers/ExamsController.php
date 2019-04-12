<?php

namespace App\Http\Controllers;

use App\Choice;
use App\Exam;
use App\Question;
use App\QuestionType;
use App\Subject;
use App\User;
use Auth;
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

        return response()->json(['success', 'url' => route('exams'), 'msg' => __('global.saved_successfully')], 200);
    }

    public function update(Exam $exam, Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'date' => 'required|date|date_format:Y-m-d|after:today',
            'subject_id' => 'required|exists:subjects,id',
            'text' => 'required|string'
        ]);

        $exam->update($request->input());

        return redirect()->route('exams');
    }

    public function deleteExam(Exam $exam)
    {
        $exam->delete();
        return response()->json(['success', 'url' => route('exams')], 200);
    }


}
