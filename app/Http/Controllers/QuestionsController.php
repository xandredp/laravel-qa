<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;

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

    public function create() {
        $question = new Question();

        return view('questions.create', compact('question'));
    }

    // Seperated validation into seperate file
    public function store(AskQuestionRequest $request) {
        $request->user()->questions()->create($request->all());

        return redirect()->route('questions.index')->with('success', 'Your question has been submitted.');
    }
}
