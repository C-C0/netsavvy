@extends('layouts.app')

@section('content')
    <h1>{{ $module->title }}</h1>
    <p>{{ $module->description }}</p>

    <h2>Courses in this Module:</h2>
    <ul>
        @foreach($module->courses as $course)
            <li>
                <a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a>
                ({{ $course->required_skill_level }})
            </li>
        @endforeach
    </ul>

    <a href="{{ route('modules.edit', $module->id) }}">Edit Module</a>

    <form action="{{ route('modules.destroy', $module->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Module</button>
    </form>

    <a href="{{ route('modules.index') }}">Back to Modules</a>
@endsection