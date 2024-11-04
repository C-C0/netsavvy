<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\Module;
use App\Models\Tutorial;
use App\Models\Quiz;
use App\Models\CTFChallenge;

class Courses extends Component
{
    public $courses, $title, $description, $module_id, $tutorial_id, $quiz_id, $c_t_f_challenge_id, $required_skill_level, $preferred_learning_style, $courseId;
    public $isOpen = 0;

    public function render()
    {
        $this->courses = Course::all();
        $modules = Module::all();
        $tutorials = Tutorial::all();
        $quizzes = Quiz::all();
        $c_t_f_challenges = CTFChallenge::all();

        return view('livewire.courses', compact('modules', 'tutorials', 'quizzes', 'c_t_f_challenges'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->module_id = null;
        $this->tutorial_id = null;
        $this->quiz_id = null;
        $this->c_t_f_challenge_id = null;
        $this->required_skill_level = '';
        $this->preferred_learning_style = '';
        $this->courseId = null;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'module_id' => 'required|exists:modules,id',
            'tutorial_id' => 'required|exists:tutorials,id',
            'quiz_id' => 'required|exists:quizzes,id',
            'c_t_f_challenge_id' => 'required|exists:c_t_f_challenges,id',
            'required_skill_level' => 'nullable|string',
            'preferred_learning_style' => 'nullable|in:Visual,Auditory,Kinesthetic',
        ]);

        Course::updateOrCreate(['id' => $this->courseId], [
            'title' => $this->title,
            'description' => $this->description,
            'module_id' => $this->module_id,
            'tutorial_id' => $this->tutorial_id,
            'quiz_id' => $this->quiz_id,
            'c_t_f_challenge_id' => $this->c_t_f_challenge_id,
            'required_skill_level' => $this->required_skill_level,
            'preferred_learning_style' => $this->preferred_learning_style,
        ]);

        $this->closeModal();
        $this->resetInputFields();
        session()->flash('message', $this->courseId ? 'Course Updated Successfully.' : 'Course Created Successfully.');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $this->courseId = $course->id;
        $this->title = $course->title;
        $this->description = $course->description;
        $this->module_id = $course->module_id;
        $this->tutorial_id = $course->tutorial_id;
        $this->quiz_id = $course->quiz_id;
        $this->c_t_f_challenge_id = $course->c_t_f_challenge_id;
        $this->required_skill_level = $course->required_skill_level;
        $this->preferred_learning_style = $course->preferred_learning_style;

        $this->openModal();
    }

    public function delete($id)
    {
        Course::find($id)->delete();
        session()->flash('message', 'Course Deleted Successfully.');
    }
}