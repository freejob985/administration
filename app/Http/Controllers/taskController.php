<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class taskController extends Controller
{


   public function task()
    {
        return view('pag.task'); // عرض البيانات في العرض المناسب
    }
   public function mental()
    {
        return view('pag.mental'); // عرض البيانات في العرض المناسب
    }

public function store(Request $request, Project $project)
    {
        $task = new Task();
        $task->name = $request->input('name');
        $task->project_id = $project->id;
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
