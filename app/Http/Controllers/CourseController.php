<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\Tutorial;
use App\Models\Quiz;
use App\Models\CTFChallenge;
use Illuminate\Http\Request;

class CourseController extends Controller
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
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with(['module', 'tutorial', 'quiz', 'ctfChallenge'])->get();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = Module::all();
        $tutorials = Tutorial::all();
        $quizzes = Quiz::all();
        $ctfChallenges = CTFChallenge::all();
        return view('courses.create', compact('modules', 'tutorials', 'quizzes', 'ctfChallenges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'module_id' => 'required|exists:modules,id',
            'tutorial_id' => 'required|exists:tutorials,id',
            'quiz_id' => 'required|exists:quizzes,id',
            'c_t_f_challenge_id' => 'required|exists:c_t_f_challenges,id',
            'required_skill_level' => 'nullable|string|max:255',
            'preferred_learning_style' => 'nullable|in:Visual,Auditory,Kinesthetic',
        ]);

        Course::create($validatedData);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $course = Course::with(['module', 'tutorial', 'quiz', 'ctfChallenge'])->findOrFail($id);
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $modules = Module::all();
        $tutorials = Tutorial::all();
        $quizzes = Quiz::all();
        $ctfChallenges = CTFChallenge::all();
        return view('courses.edit', compact('course', 'modules', 'tutorials', 'quizzes', 'ctfChallenges'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'module_id' => 'required|exists:modules,id',
            'tutorial_id' => 'required|exists:tutorials,id',
            'quiz_id' => 'required|exists:quizzes,id',
            'c_t_f_challenge_id' => 'required|exists:c_t_f_challenges,id',
            'required_skill_level' => 'nullable|string|max:255',
            'preferred_learning_style' => 'nullable|in:Visual,Auditory,Kinesthetic',
        ]);

        $course = Course::findOrFail($id);
        $course->update($validatedData);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
