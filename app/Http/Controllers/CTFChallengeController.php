<?php

namespace App\Http\Controllers;

use App\Models\CTFChallenge;
use App\Models\Course;
use Illuminate\Http\Request;

class CTFChallengeController extends Controller
{
    public function index()
    {
        $challenges = CTFChallenge::all();
        return view('challenges.index', compact('challenges'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('challenges.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'course_id' => 'required|exists:courses,id'
        ]);

        CTFChallenge::create($request->all());
        return redirect()->route('challenges.index')->with('success', 'Challenge created successfully.');
    }

    public function show($id)
    {
        $challenge = CTFChallenge::findOrFail($id);
        return view('challenges.show', compact('challenge'));
    }

    public function edit($id)
    {
        $challenge = CTFChallenge::findOrFail($id);
        $courses = Course::all();
        return view('challenges.edit', compact('challenge', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $challenge = CTFChallenge::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'course_id' => 'required|exists:courses,id'
        ]);

        $challenge->update($request->all());
        return redirect()->route('challenges.index')->with('success', 'Challenge updated successfully.');
    }

    public function destroy($id)
    {
        $challenge = CTFChallenge::findOrFail($id);
        $challenge->delete();
        return redirect()->route('challenges.index')->with('success', 'Challenge deleted successfully.');
    }
}

