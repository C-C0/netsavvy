<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $badges = Badge::all();
        return view('badges.index', compact('badges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('badges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Badge::create($validatedData);

        return redirect()->route('badges.index')->with('success', 'Badge created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $badge = Badge::findOrFail($id);
        return view('badges.show', compact('badge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $badge = Badge::findOrFail($id);
        return view('badges.edit', compact('badge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $badge = Badge::findOrFail($id);
        $badge->update($validatedData);

        return redirect()->route('badges.index')->with('success', 'Badge updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $badge = Badge::findOrFail($id);
        $badge->delete();

        return redirect()->route('badges.index')->with('success', 'Badge deleted successfully.');
    }
}
