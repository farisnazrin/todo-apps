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
            ->where('archived', false)
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
        'priority' => 'required|in:urgent,non-urgent',
        'due_date' => 'nullable|date',
        'place' => 'nullable|string|max:255',
    ]);

    Task::create([
        'user_id' => auth()->id(),
        'title' => $request->input('title'),
        'priority' => $request->input('priority'), // ✅ this line matters
        'color'=> $request->input('color'),
        'place'=> $request->input('place'),
        'due_date' => $request->input('due_date'),
        'completed' => false,
        'archived' => false,
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
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

    public function archive(Task $task)
{
    if ($task->user_id === auth()->id()) {
        $task->archived = true;
        $task->save();
    }

    return redirect()->route('tasks.index')->with('success', 'Task archived.');
}


    public function archived()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->where('archived', true)
            ->orderBy('updated_at', 'desc')
            ->get();
    
        return view('tasks.archived', compact('tasks'));
    }
    
    public function restore(Task $task)
{
    // Instead of authorize, do a manual check
    if ($task->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    $task->archived = false;
    $task->save();

    return redirect()->route('tasks.archived')->with('success', 'Task restored successfully.');
}

public function edit(Task $task)
{
    if ($task->user_id !== auth()->id()) {
        abort(403);
    }

    return view('tasks.edit', compact('task'));
}

public function update(Request $request, Task $task)
{
    if ($task->user_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'title' => 'required',
        'priority' => 'required|in:urgent,non-urgent',
        'color' => 'required|string',
        'due_date' => 'nullable|date',
        'place' => 'nullable|string|max:255',
    ]);

    $task->update([
        'title' => $request->title,
        'priority' => $request->priority,
        'color' => $request->color,
        'due_date' => $request->due_date,
        'place' => $request->place,
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task updated!');
}



}
