<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function handleAction(Request $request, $resource, $id = null)
    {
        $modelClass = $this->resolveModelClass($resource);
        if (!$modelClass) {
            return back()->withErrors(['Invalid resource specified']);
        }

        if ($request->isMethod('post')) {
            // For create or update based on the presence of $id
            $item = $id ? $modelClass::findOrFail($id) : new $modelClass;
            $item->fill($request->all());
            $item->save();
            $message = $id ? 'Resource updated successfully.' : 'Resource created successfully.';
        } elseif ($request->isMethod('delete')) {
            // For delete operation
            $item = $modelClass::findOrFail($id);
            $item->delete();
            $message = 'Resource deleted successfully.';
        }

        return redirect()->route('admin.manage')->with('status', $message);
    }

    private function resolveModelClass($resource)
    {
        $modelClasses = [
            'modules' => \App\Models\Module::class,
            'courses' => \App\Models\Course::class,
            'tutorials' => \App\Models\Tutorial::class,
            'c_t_f_challenges' => \App\Models\CTFChallenge::class,
            'quizzes' => \App\Models\Quiz::class,
            'quiz_questions' => \App\Models\QuizQuestion::class,
        ];

        return $modelClasses[$resource] ?? null;
    }
}