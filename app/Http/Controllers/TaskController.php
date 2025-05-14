<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Show tasks
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->orderBy('completed') // false (0) first, true (1) later
            ->orderBy('due_date')  // optional: sort by due date within each section
            ->get();
    
        return view('tasks.index', compact('tasks'));
    }

    // Store a new task
    public function create()
{
    return view('tasks.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'due_date' => 'nullable|date',
    ]);

    Task::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
        'due_date' => $request->due_date,
        'completed' => false,
    ]);

    return redirect()->route('tasks.index');
}
    // Toggle task completion
    public function toggle(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update(['completed' => !$task->completed]);
        return redirect()->route('tasks.index');
    }
    public function complete(Task $task)
    {
        // Only allow the task owner
        if ($task->user_id === auth()->id()) {
            $task->completed = !$task->completed; // Toggle the status
            $task->save();
        }
    
        return redirect()->route('tasks.index');
    }
    
    // Delete a task
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('tasks.index');
    }
}
