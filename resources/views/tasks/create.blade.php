@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-white border-0 pb-0">
                    <h4 class="fw-bold text-primary text-center">📝 Create a New Task</h4>
                    <p class="text-muted text-center mb-0">Keep your productivity on track</p>
                </div>

                <div class="card-body pt-3">
                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-warning rounded-3">
                            <h6 class="fw-semibold">⚠ Please fix the following issues:</h6>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Task Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control form-control-lg rounded-3 shadow-sm" placeholder="E.g., homework teacher aini" required>
                        </div>

                        <!-- Due Date -->
                        <div class="mb-4">
                            <label for="due_date" class="form-label fw-semibold">Due Date & Time</label>
                            <input type="datetime-local" name="due_date" class="form-control rounded-3 shadow-sm">
                            <div class="form-text">Optional — set a deadline if needed</div>
                        </div>
                        <!-- Priority -->
                        <div class="mb-4">
                            <label for="priority" class="form-label fw-semibold">Priority <span class="text-danger">*</span></label>
                            <select name="priority" id="priority" class="form-select form-select-lg rounded-3 shadow-sm" required>
                                <option value="non-urgent" selected>Non-Urgent</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                        <!-- Color Picker -->
                        <div class="mb-4">
                            <label for="color" class="form-label fw-semibold">Task Color</label>
                            <input type="color" name="color" class="form-control form-control-color" value="#ffffff" title="Choose your color">
                        </div>
                        <!-- Place -->
                        <div class="mb-4">
                            <label for="place" class="form-label fw-semibold">Task Location / Place</label>
                            <input type="text" name="place" class="form-control rounded-3 shadow-sm" placeholder="E.g., Library, Home, Office">
                            <div class="form-text">Optional — describe where the task will happen</div>
                        </div>
                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                                ← Cancel
                            </a>
                            <button type="submit" class="btn btn-success px-4 py-2 rounded-3">
                                ✅ Save Task
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
