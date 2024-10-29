@extends('layouts.app')

@section('content')
    <h1>Edit Module</h1>

    <form action="{{ route('modules.update', $module->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $module->title }}" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required>{{ $module->description }}</textarea>

        <button type="submit">Update Module</button>
    </form>

    <a href="{{ route('modules.show', $module->id) }}">Back to Module Details</a>
@endsection