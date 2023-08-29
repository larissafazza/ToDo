@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Hello, {{ Auth::user()->name }} You are logged in!
                    <div class="div-button-access-index">
                        <a href="{{ route('todos.index') }}" class="btn btn-light button-access-index">Click here to access your tasks</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
