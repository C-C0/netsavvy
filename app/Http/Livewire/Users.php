<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public $users, $name, $email, $avatar, $skill_level, $preferred_learning_style, $role, $userId;
    public $isOpen = 0;

    public function render()
    {
        //Load user dynamically to prevent unintentional re-rendering
        return view('livewire.users', [
            'users' => User::all()
        ]);
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
        $this->name = '';
        $this->email = '';
        $this->avatar = null;
        $this->skill_level = '';
        $this->preferred_learning_style = '';
        $this->role = 'student';  // Default role
        $this->userId = null;
    }

    /** Needs to double later for 
     * set up proper file storage and permissions 
     * (php artisan storage:link) for avatars icons*/
    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'avatar' => 'nullable|image|max:1024',
            'skill_level' => 'nullable|string',
            'preferred_learning_style' => 'nullable|in:Visual,Auditory,Kinesthetic',
            'role' => 'required|in:admin,lecturer,student'
        ]);
        //Optimize update and store as method update streamline into here
        // Also, corrected the correct namespace referencing from $User to User
        User::updateOrCreate(['id' => $this->userId], [
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar ? $this->avatar->store('avatars') : null,
            'skill_level' => $this->skill_level,
            'preferred_learning_style' => $this->preferred_learning_style,
            'role' => $this->role,
        ]);

        $this->closeModal();
        $this->resetInputFields();
        session()->flash('message', $this->userId ? 'User Updated Successfully.'
         : 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->avatar = $user->avatar;
        $this->skill_level = $user->skill_level;
        $this->preferred_learning_style = $user->preferred_learning_style;
        $this->role = $user->role;

        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User deleted successfully.');
    }

   
}