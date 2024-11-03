<!-- resources/views/badges/index.blade.php 
  contain the listing of all badges, 
  allow to manage them (view, create, edit, delete)-->
@extends('layouts.app')

@section('content')
<h1>Badges</h1>
@if(auth()->user()->isAdmin())
    <a href="{{ route('badges.create') }}" class="btn btn-primary">Add Badge</a>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            @if(auth()->user()->isAdmin())
                <th>Actions</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($badges as $badge)
            <tr>
                <td>{{ $badge->name }}</td>
                <td>{{ $badge->description }}</td>
                @if(auth()->user()->isAdmin())
                    <td>
                        <a href="{{ route('badges.edit', $badge->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('badges.destroy', $badge->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

