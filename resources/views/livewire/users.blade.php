@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">User Management</h1>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Add User Button (Only for Admins) -->
    @if (auth()->user()->role === 'admin')
        <button wire:click="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
            Add New User
        </button>
    @endif

    <h2> All Users</h2>
    <!-- Users Table -->
    <table class="w-full bg-white rounded-lg shadow-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-200 text-left text-gray-700 uppercase text-sm">
                <th class="py-2 px-4">Name</th>
                <th class="py-2 px-4">Email</th>
                <th class="py-2 px-4">Role</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $user->name }}</td>
                    <td class="py-2 px-4">{{ $user->email }}</td>
                    <td class="py-2 px-4">{{ ucfirst($user->role) }}</td>
                    <td class="py-2 px-4">
                        <!-- Edit Button (Only for Admins and Lecturers) -->
                        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'lecturer')
                            <button wire:click="edit({{ $user->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">
                                Edit
                            </button>
                        @endif

                        <!-- Delete Button (Only for Admins) -->
                        @if (auth()->user()->role === 'admin')
                            <button wire:click="delete({{ $user->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                Delete
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- User Modal (Only for Admins) -->
    @if($isOpen && auth()->user()->role === 'admin')
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-lg">
                <h2 class="text-xl font-bold mb-4">{{ $userId ? 'Edit User' : 'Create User' }}</h2>

                <form wire:submit.prevent="store">
                    <!-- Name Input -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" id="name" wire:model="name" class="w-full px-3 py-2 border rounded" placeholder="Enter name">
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email Input -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" id="email" wire:model="email" class="w-full px-3 py-2 border rounded" placeholder="Enter email">
                        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Avatar Upload -->
                    <div class="mb-4">
                        <label for="avatar" class="block text-gray-700">Avatar</label>
                        <input type="file" id="avatar" wire:model="avatar" class="w-full">
                        @error('avatar') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Skill Level -->
                    <div class="mb-4">
                        <label for="skill_level" class="block text-gray-700">Skill Level</label>
                        <input type="text" id="skill_level" wire:model="skill_level" class="w-full px-3 py-2 border rounded" placeholder="Enter skill level">
                        @error('skill_level') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Preferred Learning Style -->
                    <div class="mb-4">
                        <label for="preferred_learning_style" class="block text-gray-700">Preferred Learning Style</label>
                        <select id="preferred_learning_style" wire:model="preferred_learning_style" class="w-full px-3 py-2 border rounded">
                            <option value="">Select a style</option>
                            <option value="Visual">Visual</option>
                            <option value="Auditory">Auditory</option>
                            <option value="Kinesthetic">Kinesthetic</option>
                        </select>
                        @error('preferred_learning_style') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Role -->
                    <div class="mb-4">
                        <label for="role" class="block text-gray-700">Role</label>
                        <select id="role" wire:model="role" class="w-full px-3 py-2 border rounded">
                            <option value="student">Student</option>
                            <option value="lecturer">Lecturer</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Modal Buttons -->
                    <div class="flex justify-end">
                        <button type="button" wire:click="closeModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ $userId ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>


@endsection
