@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-white border-0 pb-0">
                    <h4 class="fw-bold text-primary text-center">✏️ Edit Task</h4>
                    <p class="text-muted text-center mb-0">Fix typos or update the task info</p>
                </div>

                <div class="card-body pt-3">
                    @if ($errors->any())
                        <div class="alert alert-warning rounded-3">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Task Title</label>
                            <input type="text" name="title" value="{{ old('title', $task->title) }}"
                                class="form-control form-control-lg rounded-3 shadow-sm" required>
                        </div>

                        <!-- Due Date -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Due Date & Time</label>
                            <input type="datetime-local" name="due_date"
                                value="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i') : '' }}"
                                class="form-control rounded-3 shadow-sm">
                        </div>

                        <!-- Priority -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Priority</label>
                            <select name="priority" class="form-select shadow-sm">
                                <option value="non-urgent" {{ $task->priority === 'non-urgent' ? 'selected' : '' }}>Non-Urgent</option>
                                <option value="urgent" {{ $task->priority === 'urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                        </div>

                        <!-- Color -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Task Color</label>
                            <div class="d-flex flex-wrap gap-2">
                        
                                @php
                                    $colors = ['#FF0000', '#FFA500', '#FFFF00', '#008000','#0000FF', '#4B0082', '#EE82EE', '#A52A2A','#FFC0CB', '#000000', '#808080', '#FFFFFF'];
                                @endphp
                        
                                @foreach($colors as $color)
                                    <label class="form-check-label" style="cursor: pointer;">
                                        <input type="radio" name="color" value="{{ $color }}" class="btn-check" autocomplete="off" {{ $loop->first ? 'checked' : '' }}>
                                        <span class="d-inline-block rounded-circle border border-secondary" style="width: 32px; height: 32px; background-color: {{ $color }};"></span>
                                    </label>
                                @endforeach

                        <!-- Place -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Place / Location</label>
                            <input type="text" name="place" value="{{ old('place', $task->place) }}"
                                class="form-control rounded-3 shadow-sm" placeholder="E.g., Office, Home">
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                                ← Cancel
                            </a>
                            <button type="submit" class="btn btn-success px-4 py-2 rounded-3">
                                💾 Update Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
