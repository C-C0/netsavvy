<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Apply Middleware to the Controller
     * Now each method remains cleaner, without needing to add role checks manually
    */
    public function __construct()
    {
        // Allow students, lecturers, and admins to view modules
        $this->middleware('role:student,lecturer,admin')->only(['index', 'show']);
        
        // Allow only lecturers and admins to create, update, or delete modules
        $this->middleware('role:lecturer,admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('quizzes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'course_id' => 'required|exists:courses,id'
        ]);

        Quiz::create($request->all());
        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully.');
    }

    public function show($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('quizzes.show', compact('quiz'));
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $courses = Course::all();
        return view('quizzes.edit', compact('quiz', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'course_id' => 'required|exists:courses,id'
        ]);

        $quiz->update($request->all());
        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
    }
}
