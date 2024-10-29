@extends('layouts.app')

@section('content')
    <h1>Edit Course</h1>

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $course->title }}" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required>{{ $course->description }}</textarea>

        <label for="module_id">Module:</label>
        <select name="module_id" id="module_id" required>
            @foreach($modules as $module)
                <option value="{{ $module->id }}" {{ $course->module_id == $module->id ? 'selected' : '' }}>
                    {{ $module->name }}
                </option>
            @endforeach
        </select>

        <label for="tutorial_id">Tutorial:</label>
        <select name="tutorial_id" id="tutorial_id" required>
            @foreach($tutorials as $tutorial)
                <option value="{{ $tutorial->id }}" {{ $course->tutorial_id == $tutorial->id ? 'selected' : '' }}>
                    {{ $tutorial->name }}
                </option>
            @endforeach
        </select>

        <label for="quiz_id">Quiz:</label>
        <select name="quiz_id" id="quiz_id" required>
            @foreach($quizzes as $quiz)
                <option value="{{ $quiz->id }}" {{ $course->quiz_id == $quiz->id ? 'selected' : '' }}>
                    {{ $quiz->title }}
                </option>
            @endforeach
        </select>

        <label for="c_t_f_challenge_id">CTF Challenge:</label>
        <select name="c_t_f_challenge_id" id="c_t_f_challenge_id" required>
            @foreach($ctfChallenges as $challenge)
                <option value="{{ $challenge->id }}" {{ $course->c_t_f_challenge_id == $challenge->id ? 'selected' : '' }}>
                    {{ $challenge->title }}
                </option>
            @endforeach
        </select>

        <label for="required_skill_level">Required Skill Level:</label>
        <input type="text" name="required_skill_level" id="required_skill_level" value="{{ $course->required_skill_level }}">

        <label for="preferred_learning_style">Preferred Learning Style:</label>
        <select name="preferred_learning_style" id="preferred_learning_style">
            <option value="Visual" {{ $course->preferred_learning_style == 'Visual' ? 'selected' : '' }}>Visual</option>
            <option value="Auditory" {{ $course->preferred_learning_style == 'Auditory' ? 'selected' : '' }}>Auditory</option>
            <option value="Kinesthetic" {{ $course->preferred_learning_style == 'Kinesthetic' ? 'selected' : '' }}>Kinesthetic</option>
        </select>

        <button type="submit">Update Course</button>
    </form>

    <a href="{{ route('courses.show', $course->id) }}">Back to Course Details</a>
@endsection