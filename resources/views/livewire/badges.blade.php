@extends('layouts.app')

@section('content')
<div>
    <h1>Badges Management</h1>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Add Badge Button (Only for Admins) -->
    @if (auth()->user()->role === 'admin')
        <button wire:click="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
            Add New Badge
        </button>
    @endif

    <!-- Badges Table -->
     <table class="w-full bg-white rounded-lg shadow-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-200 text-left text-gray-700 uppercase text-sm">
                <th class="py-2 px-4">Title</th>
                <th class="py-2 px-4">Description</th>
                <th class="py-2 px-4">Criteria</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($badges as $badge)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $badge->title }}</td>
                    <td class="py-2 px-4">{{ $badge->description }}</td>
                    <td class="py-2 px-4">{{ $badge->criteria }}</td>
                    <td class="py-2 px-4">
                        <!-- Edit Button (Only for Admins) -->
                        @if (auth()->user()->role === 'admin')
                            <button wire:click="edit({{ $badge->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">
                                Edit
                            </button>
                            <button wire:click="delete({{ $badge->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                Delete
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Badge Modal (Only for Admins) -->
    @if($isOpen && auth()->user()->role === 'admin')
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-lg">
                <h2 class="text-xl font-bold mb-4">{{ $badgeId ? 'Edit Badge' : 'Create Badge' }}</h2>

                <form wire:submit.prevent="store">
                    <!-- Title Input -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">Title</label>
                        <input type="text" id="title" wire:model="title" class="w-full px-3 py-2 border rounded" placeholder="Enter badge title">
                        @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description Input -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea id="description" wire:model="description" class="w-full px-3 py-2 border rounded" placeholder="Enter badge description"></textarea>
                        @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Icon Upload -->
                    <div class="mb-4">
                        <label for="icon" class="block text-gray-700">Badge Icon</label>
                        <input type="file" id="icon" wire:model="icon" class="w-full">
                        @error('icon') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Criteria Input -->
                    <div class="mb-4">
                        <label for="criteria" class="block text-gray-700">Criteria</label>
                        <textarea id="criteria" wire:model="criteria" class="w-full px-3 py-2 border rounded" placeholder="Enter badge criteria"></textarea>
                        @error('criteria') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Modal Buttons -->
                    <div class="flex justify-end">
                        <button type="button" wire:click="closeModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ $badgeId ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection