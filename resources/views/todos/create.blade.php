@extends('layouts.app')

@section('title')
    Create new task
@endsection

@section('content')
    <form class="to-do-form" method="post" action="{{ route('todos.store') }}" id="create-form" enctype="multipart/form-data" onsubmit="return validarForm()">
        @csrf
        <div class="form-group">
            <label class="label">Title</label>
            <input id="form-title" class="form-input" name="title" type="text" required>
        </div>
        <div class="form-group">
            <label class="label">Description</label>
            <input id="form-description" class="form-input" name="description" type="text" required>
        </div>
        <div class="form-group">
            <label class="label">Deadline</label>
            <input id="form-date" class="form-input" name="date" type="date" required>
        </div>
        <div class="form-group">
            <label class="label">Conclusion</label>
            <select id="form-priority" class="form-input" name="done" aria-label="Default select example" required>
                <option value="" disabled selected hidden>Select</option>
                <option value="0">Unfinished</option>
                <option value="1">Finished</option>
            </select>
        </div>
        <div class="form-group">
            <label class="label">Priority</label>
            <select id="form-priority" class="form-input" name="priority" aria-label="Default select example" required>
                <option value="" disabled selected hidden>Select</option>
                <option value="Urgent">Urgent</option>
                <option value="Important">Important</option>
                <option value="Not a priority">Not a priority</option>
            </select>
        </div>
        <div class="form-group">
            <label class="label">File</label>
            <div class="input-group">
            <input type="file" class="form-control" id="inputGroupFile04" name="file" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            </div>
        </div>
        <button type="submit" name="submit" class="btn-form btn btn-light">Save</button>
        <a href="{{ route('todos.index') }}" class="btn-cancel btn btn-light">Cancel</a>
    </form>
@endsection
