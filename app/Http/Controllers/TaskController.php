<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.tasks.index', ['tasks' => Task::where('user_id', auth()->user()->id)->orderBy('end_date')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->input('project_id')) {
            $project = Project::where(['user_id' => auth()->user()->id, 'id' => $request->input('project_id')])->get();
            if ($project->count() == 0) {
                return to_route('tasks.create');
            }
        }
        return view('user.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'        => 'required|min:2|max:50',
            'description' => 'nullable|min:10|max:100',
            'project_id'  => 'nullable|exists:projects,id',
            'end_date'    => 'nullable|date|after_or_equal:' . now()->format('d-m-Y')
        ]);

        $validate['user_id'] = auth()->user()->id;
        Task::create($validate);
        return back()->with('success', 'New task created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.tasks.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        if ($task->user_id != auth()->user()->id)
            return to_route('tasks.create')->with('error', 'Task invalid! create new one');
        return view('user.tasks.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);
        if ($task->user_id != auth()->user()->id)
            return to_route('tasks.create')->with('error', 'Task invalid! create new one');
        $validate = $request->validate([
            'name'        => 'required|min:2|max:50',
            'description' => 'nullable|min:10|max:100',
            'project_id'  => 'nullable|exists:projects,id',
            'end_date'    => 'nullable|date|after_or_equal:' . now()->format('d-m-Y')
        ]);

        $task->update($validate);
        return back()->with('updated', 'Task updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        if ($task->user_id != auth()->user()->id)
            return to_route('tasks.create')->with('error', 'Task invalid! create new one');
        Task::destroy($id);
        return back()->with('deleted', 'Task deleted!');
    }
}
