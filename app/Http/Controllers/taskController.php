<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function task()
    {
        return view('pag.task'); // عرض البيانات في العرض المناسب
    }

    public function mental($id)
    {
        return view('pag.mental', compact('id')); // عرض البيانات في العرض المناسب
    }

    public function store(Request $request, Project $project)
    {
        $task = new Task();
        $task->name = $request->input('name');
        $task->project_id = $project->id;
        $task->save();

        return response()->json(['success' => true, 'id' => $task->id]);
    }

    public function updatePosition(Request $request, Task $task)
    {
        $task->data_x = $request->input('data_x');
        $task->data_y = $request->input('data_y');
        $task->save();

        return response()->json(['success' => true]);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['success' => true]);
    }

    public function update(Request $request, Task $task)
    {
        $task->completed = $request->input('completed');
        $task->save();

        return response()->json(['success' => true]);
    }

    public function notebook()
    {
        return view('pag.notebook'); // عرض البيانات في العرض المناسب
    }
}
