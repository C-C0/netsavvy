<?php

namespace App\Http\Controllers;

use App\Models\QuizQuestion;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function index($quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        return view('questions.index', compact('quiz'));
    }

    public function create($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        return view('questions.create', compact('quiz'));
    }

    public function store(Request $request, $quizId)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'quiz_id' => 'required|exists:quizzes,id'
        ]);

        QuizQuestion::create($request->all());
        return redirect()->route('questions.index', $quizId)->with('success', 'Question added successfully.');
    }

    public function show($quizId, $id)
    {
        $question = QuizQuestion::findOrFail($id);
        return view('questions.show', compact('question'));
    }

    public function edit($quizId, $id)
    {
        $question = QuizQuestion::findOrFail($id);
        $quiz = Quiz::findOrFail($quizId);
        return view('questions.edit', compact('question', 'quiz'));
    }

    public function update(Request $request, $quizId, $id)
    {
        $question = QuizQuestion::findOrFail($id);
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $question->update($request->all());
        return redirect()->route('questions.index', $quizId)->with('success', 'Question updated successfully.');
    }

    public function destroy($quizId, $id)
    {
        $question = QuizQuestion::findOrFail($id);
        $question->delete();
        return redirect()->route('questions.index', $quizId)->with('success', 'Question deleted successfully.');
    }
}
