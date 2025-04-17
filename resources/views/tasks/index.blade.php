@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">My To-Do List</h2>

    <form method="POST" action="{{ route('tasks.store') }}" class="mb-3">
        @csrf
        <div class="input-group">
            <input type="text" name="title" class="form-control" placeholder="Add a new task" required>
            <button class="btn btn-primary" type="submit">Add</button>
        </div>
    </form>

    @foreach($tasks as $task)
        <div class="card mb-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <form method="POST" action="{{ route('tasks.complete', $task) }}" class="d-inline">
                        @csrf
                        <button class="btn btn-sm {{ $task->completed ? 'btn-success' : 'btn-outline-success' }}" type="submit">
                            {{ $task->completed ? '✔' : 'Mark Done' }}
                        </button>
                    </form>
                    <span class="ms-2 {{ $task->completed ? 'text-decoration-line-through text-muted' : '' }}">
                        {{ $task->title }}
                    </span>
                </div>
                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
