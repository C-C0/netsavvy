<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public $users, $name, $email, $avatar, $skill_level, $preferred_learning_style, $role, $userId;

    public function render()
    {
        $this->users = User::all();
        return view('livewire.users');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'avatar' => 'nullable|image|max:1024',
            'skill_level' => 'nullable|string',
            'preferred_learning_style' => 'nullable|in:Visual,Auditory,Kinesthetic',
            'role' => 'required|in:admin,lecturer,student'
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar ? $this->avatar->store('avatars') : null,
            'skill_level' => $this->skill_level,
            'preferred_learning_style' => $this->preferred_learning_style,
            'role' => $this->role,
        ]);

        $this->resetInputFields();
        session()->flash('message', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->avatar = $user->avatar;
        $this->skill_level = $user->skill_level;
        $this->preferred_learning_style = $user->preferred_learning_style;
        $this->role = $user->role;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$this->userId,
            'avatar' => 'nullable|image|max:1024',
            'skill_level' => 'nullable|string',
            'preferred_learning_style' => 'nullable|in:Visual,Auditory,Kinesthetic',
            'role' => 'required|in:admin,lecturer,student'
        ]);

        $user = User::find($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar ? $this->avatar->store('avatars') : $user->avatar,
            'skill_level' => $this->skill_level,
            'preferred_learning_style' => $this->preferred_learning_style,
            'role' => $this->role,
        ]);

        $this->resetInputFields();
        session()->flash('message', 'User updated successfully.');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User deleted successfully.');
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
}