<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = $request->input('search', '');
        $tasks = Task::where('title', 'LIKE', "%{$query}%")
            ->paginate(10);
        $totalTasks = Task::count();
        return Inertia::render(
            "Task/Index",
            [
                'tasks' => $tasks,
                'filters' => $request->only('search'),
                'total' => $totalTasks
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Task/New');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'priority' => 'required',
            'due_date' => 'required',
        ]);

        Task::create($request->all());

        return redirect()->route('task.list');

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task, Request $request)
    {
        return Inertia::render('Task/Edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'priority' => 'required',
            'due_date' => 'required',
        ]);

        $task->update($request->all());

        return redirect()->route('task.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.list');
    }
}
