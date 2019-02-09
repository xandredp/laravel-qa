<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    //@return \Illuminate\Http\Response
    public function index() {
        $questions = Question::latest()->paginate(5);

        return view('questions.index', compact('questions'));
    }
}
