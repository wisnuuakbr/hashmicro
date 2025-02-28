<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Display all task
    public function index()
    {
        $task = Task::where('user_id', Auth::id())->get();
        return view('task.index', compact('task'));
    }

    // Show add form
    public function create()
    {
        return view('task.create');
    }

    // Add proccess
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'status'      => 'required|in:pending,in_progress,completed',
        ]);

        Task::create([
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->status,
            'user_id'     => Auth::id(),
        ]);

        return redirect()->route('task.index')->with('success', 'Task created successfully');
    }

    // Show edit form
    public function edit(Task $task)
    {
        // Check if user own this task
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('task.index')->with('error', 'Unauthorized access');
        }

        return view('task.edit', compact('task'));
    }

    // Update proccess
    public function update(Request $request, Task $task)
    {
        // Check if user own this task
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('task.index')->with('error', 'Unauthorized access');
        }

        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'status'      => 'required|in:pending,in_progress,completed',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('task.index')->with('success', 'Task updated successfully');
    }

    // Delete proccess
    public function destroy(Task $task)
    {
        // Check if user owns this task
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('task.index')->with('error', 'Unauthorized access');
        }

        $task->delete();

        return redirect()->route('task.index')->with('success', 'Task deleted successfully');
    }

    // Analyze task
    public function analyze()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        $statusCounts = ['pending' => 0, 'in_progress' => 0, 'completed' => 0];
        $priorityMatrix = [];

        foreach ($tasks as $task) {
            // Check status
            if ($task->status == 'pending') {
                $statusCounts['pending']++;
                $priorityMatrix['detail_pending'][] = $task;
            } else if ($task->status == 'in_progress') {
                $statusCounts['in_progress']++;

                $daysSinceCreation = $task->created_at->diffInDays(now());
                if ($daysSinceCreation > 7) {
                    $priorityMatrix['overdue'][] = $task;
                } else {
                    $priorityMatrix['on_track'][] = $task;
                }
            } else if ($task->status == 'completed') {
                $statusCounts['completed']++;
                $priorityMatrix['finished'][] = $task;
            }
        }

        return view('task.analyze', compact('tasks', 'statusCounts', 'priorityMatrix'));
    }
}
