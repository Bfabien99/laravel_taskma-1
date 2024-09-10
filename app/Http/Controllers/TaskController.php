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
        //
        return view('user.tasks.index', ['tasks' => Task::orderBy('end_date')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('user.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'name' => 'required|min:2|max:50',
            'description' => 'nullable|min:10|max:100',
            'project_id' => 'nullable|exists:projects,id',
            'end_date' => 'nullable|date|after_or_equal:'.now()->format('d-m-Y')
        ]);

        Task::create($validate);
        return back()->with('success', 'New task created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('user.tasks.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('user.tasks.edit', ['task' => Task::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $task = Task::find($id);
        $validate = $request->validate([
            'name' => 'required|min:2|max:50',
            'description' => 'nullable|min:10|max:100',
            'project_id' => 'nullable|exists:projects,id',
            'end_date' => 'nullable|date|after_or_equal:'.now()->format('d-m-Y')
        ]);

        $task->update($validate);
        return back()->with('updated', 'Task updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Task::destroy($id);
        return back()->with('deleted', 'Task deleted!');
    }
}