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
        $tasks = \App\Models\Task::where('user_id', auth()->id())->get();
    
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
        'title' => 'required|string|max:255',
    ]);

    \App\Models\Task::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
    ]);

        return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
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
