@extends('layouts.app')

@section('title')
    Edit "{{ $todo->title }}"
@endsection

@section('content')
    <form class="to-do-form" method="post" action="{{ route('todos.update', $todo->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="label">Title</label>
            <input class="form-input" name="title" type="text" value="{{ $todo->title }}" required>
        </div>
        <div class="form-group">
            <label class="label">Description</label>
            <input class="form-input" name="description" type="text" value="{{ $todo->description }}" required>
        </div>
        <div class="form-group">
            <label class="label">Deadline</label>
            <input class="form-input" name="date" type="date" value="{{ date('Y-m-d', strtotime($todo->date)) }}" required>
        </div>
        <div class="form-group">
            <label class="label">Priority</label>
            <select class="form-input" name="priority" aria-label="Default select example" required>
                <option value="" disabled>Select</option>
                <option value="Urgent" {{ $todo->priority === 'Urgent' ? 'selected' : '' }}>Urgent</option>
                <option value="Important" {{ $todo->priority === 'Important' ? 'selected' : '' }}>Important</option>
                <option value="Not a priority" {{ $todo->priority === 'Not a priority' ? 'selected' : '' }}>Not a priority</option>
            </select>
        </div>
        <div class="form-group">
            <label class="label">Conclusion</label>
            <select class="form-input" name="done" aria-label="Default select example" required>
                <option value="0" {{ $todo->done ? '' : 'selected' }}>Unfinished</option>
                <option value="1" {{ $todo->done ? 'selected' : '' }}>Finished</option>
            </select>
        </div>

        <label class="label" required>File</label>
        @if($todo->file_path)
            <h2>Current File:</h2>
            <a class="download-file-a" href="{{ Storage::url($todo->file_path) }}" target="_blank">View File</a>
        @endif
        <div class="form-group">
            <h2>Change File:</h2>
            <div class="input-group">
            <input type="file" class="form-control" id="inputGroupFile04" name="file" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
        </div>
        </div>
        <button type="submit" name="submit" class="btn-form btn btn-light">Save</button>
        <a href="{{ route('todos.index') }}" class="btn btn-light">Cancel</a>
    </form>
@endsection
