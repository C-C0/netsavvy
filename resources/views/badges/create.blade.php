<!-- resources/views/badges/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create New Badge</h1>

    <form action="{{ route('badges.store') }}" method="POST">
        @csrf
        <label for="name">Badge Name:</label>
        <input type="text" name="name" id="name" required>
        
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        
        <button type="submit">Create Badge</button>
    </form>
@endsection