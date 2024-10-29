<!-- resources/views/courses/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create New Course</h1>

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>

        <label for="module_id">Module:</label>
        <select name="module_id" id="module_id" required>
            @foreach($modules as $module)
                <option value="{{ $module->id }}">{{ $module->name }}</option>
            @endforeach
        </select>

        <label for="tutorial_id">Tutorial:</label>
        <select name="tutorial_id" id="tutorial_id" required>
            @foreach($tutorials as $tutorial)
                <option value="{{ $tutorial->id }}">{{ $tutorial->name }}</option>
            @endforeach
        </select>

        <label for="quiz_id">Quiz:</label>
        <select name="quiz_id" id="quiz_id" required>
            @foreach($quizzes as $quiz)
                <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
            @endforeach
        </select>

        <label for="c_t_f_challenge_id">CTF Challenge:</label>
        <select name="c_t_f_challenge_id" id="c_t_f_challenge_id" required>
            @foreach($ctfChallenges as $challenge)
                <option value="{{ $challenge->id }}">{{ $challenge->title }}</option>
            @endforeach
        </select>

        <label for="required_skill_level">Required Skill Level:</label>
        <input type="text" name="required_skill_level" id="required_skill_level">

        <label for="preferred_learning_style">Preferred Learning Style:</label>
        <select name="preferred_learning_style" id="preferred_learning_style">
            <option value="Visual">Visual</option>
            <option value="Auditory">Auditory</option>
            <option value="Kinesthetic">Kinesthetic</option>
        </select>

        <button type="submit">Create Course</button>
    </form>
@endsection