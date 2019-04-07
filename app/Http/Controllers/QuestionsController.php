<?php

namespace App\Http\Controllers;

use App\QuestionType;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function showAddForm()
    {
        $questionTypes=QuestionType::all();
        return view('add-questions',compact('questionTypes'));
    }

    public function add(Request $request)
    {

    }
}
