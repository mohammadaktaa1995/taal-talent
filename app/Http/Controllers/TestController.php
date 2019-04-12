<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Question;
use App\StudentAnswer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function showExams()
    {
        $exams = Exam::orderBy('id', 'desc')->get();
        return view('test.view', compact('exams'));
    }

    public function showExamQuestions(Exam $exam)
    {
        $questions = $exam->questions()->get();

        if ($exam->page_type == 'single')
            $page = 'single';
        else
            $page = 'multi-question';

        return view('test.' . $page . '-exam-questions', compact('questions', 'exam'));
    }

    public function saveMultiAnswers(Request $request)
    {
        $student_answer = StudentAnswer::where(['user_id' => 18, 'exam_id' => $request->get('exam_id')]);
        if ($student_answer->get())
            $student_answer->delete();
        $answers = $request->get('question_answer');
        $student_answers = [];
        foreach ($answers as $key => $answer) {
            $correct_answer_text = null;
            $is_true = 0;
            $points = 0;
            $question = Question::find($key);
            $choices = $question->choices()->get();
            foreach ($choices as $choice) {

                if ($answer != $choice->text && $choice->pivot->is_correct == 1)
                    $correct_answer_text = $choice->text;

                if ($answer == null) {
                    $answer = 'This question has not been answered.';
                    continue;
                }

                if ($answer == $choice->text && $choice->pivot->is_correct == 1) {
                    $correct_answer_text = null;
                    $points = $question->point;
                    $is_true = 1;
                    continue;
                }
            }
            $student_answers[] = StudentAnswer::create(['user_id' => 18, 'exam_id' => $request->get('exam_id'), 'question_id' => $key, 'text' => $answer, 'date_of_answer' => Carbon::now(), 'is_true' => $is_true, 'correct_answer_text' => $correct_answer_text, 'points' => $points]);
        }
        $user = User::find(18);
        $mark = $user->getMarkByExamByUser($request->get('exam_id'), $user->id);
        $exam = Exam::find($request->get('exam_id'));
        $exam_mark = $exam->total_points;
        return view('test.result', compact('student_answers', 'mark', 'exam_mark'));
    }
}
