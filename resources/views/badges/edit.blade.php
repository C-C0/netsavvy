<!-- resources/views/badges/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Badge</h1>
    @if(auth()->user()->role === 'admin')
        <form action="{{ route('badges.update', $badge->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <label for="name">Badge Name:</label>
            <input type="text" name="name" id="name" value="{{ $badge->name }}" required>
            
            <label for="description">Description:</label>
            <textarea name="description" id="description">{{ $badge->description }}</textarea>
            
            <button type="submit">Update Badge</button>
        </form>
    @else
        <p>You do not have permission to edit this badge.</p>
    @endif

@endsections