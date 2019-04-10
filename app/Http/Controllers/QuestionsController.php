<?php

namespace App\Http\Controllers;

use App\Choice;
use App\Exam;
use App\Question;
use App\QuestionType;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * @param Question $question
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteQuestion(Question $question)
    {
        $question->delete();
        return response()->json(['success', 'url' => route('exams.show', [\request()->get('exam')])], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addQuestion(Request $request)
    {
        $exam = Exam::find($request->get('exam_id'));
        $question = Question::create($request->input());
        $exam->questions()->attach($question->id);


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
        return response()->json(['success', 'url' => route('exams.show', [$exam->id])], 201);
    }

    /**
     * @param Question $question
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function updateQuestion(Question $question, Request $request)
    {
        $question->update($request->input());
        $question->choices()->detach();
        $choices_ids = $question->choices()->pluck('choice_id')->toArray();
        Choice::whereIn('id', $choices_ids)->delete();

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
