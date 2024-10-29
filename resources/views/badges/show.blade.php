<!-- resources/views/badges/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>{{ $badge->name }}</h1>
    <p>{{ $badge->description }}</p>
    <a href="{{ route('badges.edit', $badge->id) }}">Edit Badge</a>
    <form action="{{ route('badges.destroy', $badge->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Badge</button>
    </form>
    <a href="{{ route('badges.index') }}">Back to all badges</a>
@endsection