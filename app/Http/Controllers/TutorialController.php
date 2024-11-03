<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use App\Models\Course;
use Illuminate\Http\Request;

class TutorialController extends Controller
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
        $tutorials = Tutorial::all();
        return view('tutorials.index', compact('tutorials'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('tutorials.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'course_id' => 'required|exists:courses,id'
        ]);

        Tutorial::create($request->all());
        return redirect()->route('tutorials.index')->with('success', 'Tutorial created successfully.');
    }

    public function show($id)
    {
        $tutorial = Tutorial::findOrFail($id);
        return view('tutorials.show', compact('tutorial'));
    }

    public function edit($id)
    {
        $tutorial = Tutorial::findOrFail($id);
        $courses = Course::all();
        return view('tutorials.edit', compact('tutorial', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $tutorial = Tutorial::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'course_id' => 'required|exists:courses,id'
        ]);

        $tutorial->update($request->all());
        return redirect()->route('tutorials.index')->with('success', 'Tutorial updated successfully.');
    }

    public function destroy($id)
    {
        $tutorial = Tutorial::findOrFail($id);
        $tutorial->delete();
        return redirect()->route('tutorials.index')->with('success', 'Tutorial deleted successfully.');
    }
}

