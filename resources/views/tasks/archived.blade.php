@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">📦 Archived Tasks</h2>

    @forelse ($tasks as $task)
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted text-decoration-line-through">
                        {{ $task->title }}
                    </div>
                    @if($task->due_date)
                        <small class="text-muted">Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y h:i A') }}</small>
                    @endif
                </div>

                <div class="d-flex gap-2">
                    <form method="POST" action="{{ route('tasks.restore', $task) }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-primary">♻ Restore</button>
                    </form>

                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">🗑 Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">No archived tasks.</div>
    @endforelse
</div>
@endsection
