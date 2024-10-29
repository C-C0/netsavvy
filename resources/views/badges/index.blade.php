<!-- resources/views/badges/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Badges</h1>
    <a href="{{ route('badges.create') }}">Create New Badge</a>
    <ul>
        @foreach ($badges as $badge)
            <li>
                <a href="{{ route('badges.show', $badge->id) }}">{{ $badge->name }}</a>
                <p>{{ $badge->description }}</p>
                <a href="{{ route('badges.edit', $badge->id) }}">Edit</a>
                <form action="{{ route('badges.destroy', $badge->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
