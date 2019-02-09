<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    //@return \Illuminate\Http\Response
    public function index() {
        //  \DB::enableQueryLog();

        $questions = Question::with('user')->latest()->paginate(5);

        return view('questions.index', compact('questions'));
        //view('questions.index', compact('questions'))->render();

        //dd(\DB::getQueryLog());
    }

    public function show() {

    }
}
