@extends('layouts.app')

@section('content')
    <h1>Create Module</h1>

    <form action="{{ route('modules.store') }}" method="POST">
        @csrf

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>

        <button type="submit">Create Module</button>
    </form>

    <a href="{{ route('modules.index') }}">Back to Modules</a>
@endsection