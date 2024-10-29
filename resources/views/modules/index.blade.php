@extends('layouts.app')

@section('content')
    <h1>Modules</h1>

    <a href="{{ route('modules.create') }}">Create New Module</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($modules as $module)
                <tr>
                    <td>{{ $module->title }}</td>
                    <td>{{ $module->description }}</td>
                    <td>
                        <a href="{{ route('modules.show', $module->id) }}">View</a>
                        <a href="{{ route('modules.edit', $module->id) }}">Edit</a>

                        <form action="{{ route('modules.destroy', $module->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection