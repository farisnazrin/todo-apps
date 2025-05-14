<div class="card mb-3 shadow-sm border-0">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div class="d-flex flex-column">
            <div class="d-flex align-items-center mb-2">
                <form method="POST" action="{{ route('tasks.complete', $task) }}" class="me-3">
                    @csrf
                    <button type="submit" class="btn btn-sm {{ $task->completed ? 'btn-success' : 'btn-outline-secondary' }}">
                        {{ $task->completed ? '✔ Done' : 'Mark Done' }}
                    </button>
                </form>

                <div class="{{ $task->completed ? 'text-muted text-decoration-line-through' : 'fw-semibold' }}">
                    {{ $task->title }}
                </div>
            </div>

            @if($task->due_date)
                <small class="text-muted ms-5">
                    📅 Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y h:i A') }}
                </small>
            @endif
        </div>

        <form method="POST" action="{{ route('tasks.destroy', $task) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">🗑 Delete</button>
        </form>
    </div>
</div>
