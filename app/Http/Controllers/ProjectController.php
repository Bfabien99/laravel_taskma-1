<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.projects.index', ['projects' => Project::where('user_id', auth()->user()->id)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'        => 'required|min:2|max:50',
            'description' => 'required|min:10|max:100',
            'start_date'  => 'required|date|after_or_equal:' . now()->format('d-m-Y'),
            'end_date'    => 'nullable|date|after_or_equal:start_date'
        ]);

        $validate['user_id'] = auth()->user()->id;
        Project::create($validate);
        return back()->with('success', 'New project created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.projects.show', ['project' => Project::findOrFail($id), 'tasks' => Task::where(['project_id' => $id, 'user_id' => auth()->user()->id])->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        if ($project->user_id != auth()->user()->id)
            return to_route('projects.create')->with('error', 'project invalid! create new one');
        return view('user.projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);
        if ($project->user_id != auth()->user()->id)
            return to_route('projects.create')->with('error', 'project invalid! create new one');
        $validate = $request->validate([
            'name'        => 'required|min:2|max:50',
            'description' => 'required|min:10|max:100',
            'start_date'  => 'required|date|after_or_equal:' . now()->format('d-m-Y'),
            'end_date'    => 'nullable|date|after_or_equal:start_date'
        ]);

        $project->update($validate);
        return back()->with('updated', 'project updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        if ($project->user_id != auth()->user()->id)
            return to_route('projects.create')->with('error', 'project invalid! create new one');
        Project::destroy($id);
        return back()->with('deleted', 'project deleted!');
    }
}
