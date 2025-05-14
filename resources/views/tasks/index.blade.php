@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">📝 My To-Do List</h2>

    <div class="text-end mb-4">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">➕ Add New Task</a>
    </div>

    {{-- Incomplete Tasks --}}
    @php $hasIncomplete = $tasks->where('completed', false)->count(); @endphp

    @if ($hasIncomplete)
        <h5 class="mb-3 text-muted">Pending Tasks</h5>
        @foreach ($tasks->where('completed', false) as $task)
            @include('tasks._task_card', ['task' => $task])
        @endforeach
    @endif

    {{-- Completed Tasks --}}
    @php $hasCompleted = $tasks->where('completed', true)->count(); @endphp

    @if ($hasCompleted)
        <h5 class="mt-5 mb-3 text-muted">Completed Tasks</h5>
        @foreach ($tasks->where('completed', true) as $task)
            @include('tasks._task_card', ['task' => $task])
        @endforeach
    @endif

    @if (!$hasIncomplete && !$hasCompleted)
        <div class="alert alert-info">You have no tasks yet.</div>
    @endif
</div>
@endsection
