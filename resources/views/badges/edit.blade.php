<!-- resources/views/badges/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Badge</h1>

    <form action="{{ route('badges.update', $badge->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="name">Badge Name:</label>
        <input type="text" name="name" id="name" value="{{ $badge->name }}" required>
        
        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ $badge->description }}</textarea>
        
        <button type="submit">Update Badge</button>
    </form>
@endsections