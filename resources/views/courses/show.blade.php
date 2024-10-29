@extends('layouts.app')

@section('content')
    <h1>{{ $course->title }}</h1>
    <p>{{ $course->description }}</p>

    <h3>Course Details</h3>
    <ul>
        <li><strong>Module:</strong> {{ $course->module->name }}</li>
        <li><strong>Tutorial:</strong> {{ $course->tutorial->name }}</li>
        <li><strong>Quiz:</strong> {{ $course->quiz->title }}</li>
        <li><strong>CTF Challenge:</strong> {{ $course->ctfChallenge->title }}</li>
        <li><strong>Required Skill Level:</strong> {{ $course->required_skill_level }}</li>
        <li><strong>Preferred Learning Style:</strong> {{ $course->preferred_learning_style }}</li>
    </ul>

    <a href="{{ route('courses.edit', $course->id) }}">Edit Course</a>

    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Course</button>
    </form>

    <a href="{{ route('courses.index') }}">Back to Courses</a>
@endsection