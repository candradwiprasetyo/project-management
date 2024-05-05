<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project; 

class TaskController extends Controller
{
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);
        $tasks = $project->tasks;
        $tasksData = $tasks->toJson();
        return view('tasks.index', compact('project', 'tasks', 'tasksData'));
    }

    public function create($projectId)
    {
        return view('tasks.create', ['projectId' => $projectId]);
    }

    public function updateStatus(Request $request, $taskId)
    {
        $request->validate([
            'status' => 'required|in:To Do,In Progress,Done', // Atur status yang diperbolehkan
        ]);

        $task = Task::findOrFail($taskId);
        $task->status = $request->status;
        $task->save();

        return redirect()->back()->with('success', 'Task status updated successfully.');
    }

    public function store(Request $request, $projectId)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        // Simpan data task ke dalam database
        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'project_id' => $projectId, // Assign project_id
            'status' => 'To Do', // Assign default status
        ]);

        return redirect()->route('projects.tasks.index', $projectId)->with('success', 'Task added successfully.');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:To Do,In Progress,Done', // Validasi status
        ]);

        $task->update(['status' => $request->status]); // Update status tugas

        return redirect()->back()->with('success', 'Task status updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete(); // Delete the task

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
