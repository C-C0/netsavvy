<!-- resources/views/badges/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create New Badge</h1>
    @if(auth()->user()->role === 'admin')
        <form action="{{ route('badges.store') }}" method="POST">
            @csrf
            <label for="name">Badge Name:</label>
            <input type="text" name="name" id="name" required>
            
            <label for="description">Description:</label>
            <textarea name="description" id="description"></textarea>
            
            <button type="submit">Create Badge</button>
        </form>
    @else
        <p>You do not have permission to create badges.</p>
    @endif
@endsection