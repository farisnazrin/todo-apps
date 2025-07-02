<div class="card mb-3 shadow-sm border-0" style="background-color: {{ $task->color ?? '#ffffff' }}20;">
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
                    @if ($task->priority === 'urgent')
                        <span class="badge bg-danger me-2">🔥 Urgent</span>
                    @else
                        <span class="badge bg-secondary me-2">Non-Urgent</span>
                    @endif
                
                    {{ $task->title }}
                </div>
                
                
            </div>

            @if($task->due_date)
                <small class="text-muted ms-5">
                    📅 Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y h:i A') }}
                </small>
            @endif
            @if($task->place)
            <small class="text-muted ms-5">
                📍 {{ $task->place }}
            </small>
            @endif


        </div>
        <!-- Button group container -->
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary">✏️</a>
            @if($task->completed && !$task->archived)
                <form method="POST" action="{{ route('tasks.archive', $task) }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-warning">📦 Archive</button>
                </form>
            @endif

            <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">🗑 </button>
            </form>
        </div>
    </div>
</div>
