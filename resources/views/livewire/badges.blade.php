@extends('layouts.app')

@section('content')
<div>
    <h1>Badges</h1>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="create">
        <input type="text" wire:model="name" placeholder="Badge Name" required>
        <textarea wire:model="description" placeholder="Badge Description"></textarea>
        <input type="file" wire:model="icon" placeholder="Badge Icon">
        <textarea wire:model="criteria" placeholder="Badge Criteria"></textarea>
        <button type="submit">Create Badge</button>
    </form>

    <h2>All Badges</h2>
    <ul>
        @foreach($badges as $badge)
            <li>
                {{ $badge->name }} - {{ $badge->description }}
                @if($badge->icon)
                    <img src="{{ asset($badge->icon) }}" alt="Badge Icon" width="50">
                @endif
                <p>Criteria: {{ $badge->criteria }}</p> <!-- Display criteria -->
                <button wire:click="edit({{ $badge->id }})">Edit</button>
                <button wire:click="delete({{ $badge->id }})">Delete</button>
            </li>
        @endforeach
    </ul>
</div>
@endsection