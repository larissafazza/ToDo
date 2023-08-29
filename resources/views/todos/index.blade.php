@extends('layouts.app')
@section('title')
    My To-do List
@endsection
@section('content')
    @if(Session::has('deleted_message'))
        <script>
            alert('{{ Session::get('deleted_message') }}');
        </script>
    @endif

    <a href="{{ route('todos.create') }}" class="btn btn-light">New task</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Date</th>
                <th scope="col">priority</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todos as $todo)
            <tr>
                <td>{{ $todo->title }}</td>
                <td class="description">{{ $todo->description }}</td>
                <td>{{ $todo->date->format('d/m/Y') }}</td>
                <td>{{ $todo->priority }}</td>
                <td>
                    <button title="Open task" class="btn btn-icon"><a href="{{ route('todos.show', $todo->id) }}"><ion-icon class="icon open-icon" name="eye"></ion-icon></a></button>
                    <button title="Edit" class="btn btn-icon"><a href="{{ route('todos.edit', $todo->id) }}"><ion-icon class="icon edit-icon" name="create"></ion-icon></a></button>
                    <form id="delete-form-{{ $todo->id }}" action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" title="Delete" class="btn btn-icon" onclick="confirmDelete({{ $todo->id }})">
                            <ion-icon class="icon delete-icon" name="trash"></ion-icon>
                        </button>
                    </form>

                    <form class = "check-button-class" id="markAsDoneForm{{ $todo->id }}" action="{{ route('todos.markAsDone', $todo->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button id="checkButton{{ $todo->id }}" title="Mark as finished" class="btn btn-icon {{ $todo->done ? 'done' : 'undone' }}">
                            <ion-icon class="icon {{ $todo->done ? 'done' : 'undone' }}" name="checkmark-circle"></ion-icon>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
