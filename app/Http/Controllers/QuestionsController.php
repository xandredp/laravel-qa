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

    public function show(Question $question) {
        $question->increment('views');

        return view('questions.show', compact('question'));
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

    public function edit(Question $question) {
        if (\Gate::denies('update-question', $question)) {
            abort(403, "Accesss denied.");
        }
        return view("questions.edit", compact('question'));
    }

    public function update(AskQuestionRequest $request, Question $question) {
        if (\Gate::denies('update-question', $question)) {
            abort(403, "Accesss denied.");
        }

        $question->update($request->only('title', 'body'));

        return redirect('/questions')->with('success', 'Your question has been updated.');
    }

    public function destroy(Question $question) {
        if (\Gate::denies('delete-question', $question)) {
            abort(403, "Accesss denied.");
        }
        
        $question->delete();

        return redirect('/questions')->with('success', 'Your question has been deletec.');
    }
}
