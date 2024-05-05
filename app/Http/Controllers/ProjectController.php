<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;


class ProjectController extends Controller
{
    public function index()
    {
        // Menghitung jumlah proyek yang mendekati tenggat waktu (misalnya, tenggat waktu dalam 7 hari dari sekarang)
        $projects = Project::all();

        // Menambahkan status ke setiap proyek berdasarkan tanggal tenggat waktu
        foreach ($projects as $project) {
            if ($project->due_date <= now()->addDays(7)) {
                $project->status = '<span style="color: red">Proyek mendekati deadline</span>';
            } else {
                $project->status = '<span style="color: green">Sesuai jadwal</span>';
            }
        }

        // Mengambil status dari setiap tugas dan menambahkannya ke status proyek jika ada tugas yang belum selesai
        foreach ($projects as $project) {
            $unfinishedTasks = $project->tasks()->where('status', '!=', 'Done')->count();
            if ($unfinishedTasks > 0) {
                if ($project->status == '') {
                    $project->status = '<span style="color: red">Ada tugas yang belum selesai</span>';
                } else {
                    $project->status .= ' <span style="color: red">dan ada tugas yang belum selesai</span>';
                }
                break; // Keluar dari loop jika telah menemukan proyek dengan tugas yang belum selesai
            }
        }

        return view('projects.index', ['projects' => $projects]);
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $date = $request->input('date');

        $projects = Project::query();

        if ($name) {
            $projects->where('name', 'like', '%'.$name.'%');
        }

        if ($date) {
            $projects->whereDate('start_date', $date);
        }

        $results = $projects->get();

        return view('projects.search_results', ['results' => $results, 'request' => $request]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
        ]);
        Project::create($request->all());
        return redirect()->route('projects.index')
                         ->with('success','Project created successfully.');
    }

    public function edit($id)
    {
        $project = Project::find($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'due_date' => 'required|date|after:start_date',
        ]);

        $project = Project::find($id);
        $project->update($request->all());

        return redirect()->route('projects.index')->with('success','Project updated successfully');
    }

    public function destroy($id)
    {
        Project::find($id)->delete();

        return redirect()->route('projects.index')->with('success','Project deleted successfully');
    }

    public function addTask(Request $request, $projectId)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $project = Project::findOrFail($projectId);
        $task = new Task([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'To Do', // Atur status default jika diperlukan
        ]);
        $project->tasks()->save($task);

        return redirect()->route('projects.show', $projectId)->with('success', 'Task added successfully.');
    }

}
