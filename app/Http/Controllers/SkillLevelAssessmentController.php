<?php

namespace App\Http\Controllers;

use App\Models\SkillLevelAssessment;
use App\Models\User;
use Illuminate\Http\Request;

class SkillLevelAssessmentController extends Controller
{
    public function index()
    {
        $assessments = SkillLevelAssessment::with('user')->get();
        return view('assessments.index', compact('assessments'));
    }

    public function create()
    {
        $users = User::all();
        return view('assessments.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'skill_level' => 'required|string',
            'assessment_details' => 'required|string'
        ]);

        SkillLevelAssessment::create($request->all());
        return redirect()->route('assessments.index')->with('success', 'Assessment created successfully.');
    }

    public function show($id)
    {
        $assessment = SkillLevelAssessment::with('user')->findOrFail($id);
        return view('assessments.show', compact('assessment'));
    }

    public function edit($id)
    {
        $assessment = SkillLevelAssessment::findOrFail($id);
        $users = User::all();
        return view('assessments.edit', compact('assessment', 'users'));
    }

    public function update(Request $request, $id)
    {
        $assessment = SkillLevelAssessment::findOrFail($id);
        $request->validate([
            'skill_level' => 'required|string',
            'assessment_details' => 'required|string'
        ]);

        $assessment->update($request->all());
        return redirect()->route('assessments.index')->with('success', 'Assessment updated successfully.');
    }

    public function destroy($id)
    {
        SkillLevelAssessment::destroy($id);
        return redirect()->route('assessments.index')->with('success', 'Assessment deleted successfully.');
    }
}
