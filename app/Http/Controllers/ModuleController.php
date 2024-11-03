<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
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
        $modules = Module::all();
        return view('modules.index', compact('modules'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('modules.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Module::create($request->all());

        return redirect()->route('modules.index')->with('success', 'Module created successfully.');
    }

    // Display the specified resource.
    public function show($id)
    {
        $module = Module::findOrFail($id);
        return view('modules.show', compact('module'));
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $module = Module::findOrFail($id);
        return view('modules.edit', compact('module'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $module = Module::findOrFail($id);
        $module->update($request->all());

        return redirect()->route('modules.index')->with('success', 'Module updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $module = Module::findOrFail($id);
        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Module deleted successfully.');
    }
}
