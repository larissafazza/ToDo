@extends('layouts.app')

@section('title')
    Show "{{ $todo->title }}"
@endsection
@section('content')
    <p>This task was created at: {{ $todo->created_at->format('d/m/Y H:i') }} <br>
    Last update was at: {{ $todo->updated_at->format('d/m/Y H:i') }} <br>
    Completed at: {{ $todo->completed ? $todo->completed->format('d/m/Y H:i') : 'Not completed' }}</p>


    <form class="to-do-form" method="post" action="{{ route('todos.update', $todo->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="label" required>Title</label>
            <input class="form-input" name="title" type="text" value="{{ $todo->title }}" disabled>
        </div>
        <div class="form-group">
            <label class="label" required>Description</label>
            <input class="form-input" name="description" type="text" value="{{ $todo->description }}" disabled>
        </div>
        <div class="form-group">
            <label class="label">Deadline</label>
            <input class="form-input" name="date" type="date" value="{{ date('Y-m-d', strtotime($todo->date)) }}" disabled>
        </div>
        <div class="form-group">
            <label class="label">Priority</label>
            <select style="background-color: #EFEFEF4D; color:#555" class="form-input" name="priority" aria-label="Default select example" disabled>
                <option selected>{{ $todo->priority }}</option>
            </select>
        </div>
        <div class="form-group">
            <label class="label">Conclusion</label>
            <select style="background-color: #EFEFEF4D; color:#555" class="form-input" name="done" aria-label="Default select example" disabled>
                @if ($todo->done)
                    <option selected>Finished</option>
                @else
                    <option selected>Unfinished</option>
                @endif
            </select>
        </div>

        @if($todo->file_path)
            <a href="{{ Storage::url($todo->file_path) }}" target="_blank">Download File</a>
        @else
            <label class="label" required>File</label>
            <input class="form-input" name="description" type="text" value="No file added." disabled>
        @endif
        
        <button type="submit" name="submit" class="btn-form btn btn-light">
            <a href="{{ route('todos.edit', $todo->id) }}">Edit</a>
        </button>
        <a href="{{ route('todos.index') }}" class="btn btn-light">Cancel</a>
    </form>
@endsection