<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Label;
use Illuminate\Http\Request;
use session;

class TaskController extends Controller
{



  public function update(Request $request, Task $task)
    {
        $task->completed = $request->input('completed');
        $task->save();

        return response()->json(['success' => true]);
    }
   public function task()
    {
        return view('pag.task'); // عرض البيانات في العرض المناسب
    }

    public function mental($id)
    {


        session()->put('projects', $id);
        $tasks = Task::where('project_id', $id)->get();
        // $tasks = Task::where('project_id', $id)->get();
        $ideaLabels = Label::where('type', 'idea')->where('projects',$id)->get();
        $mistakesLabels = Label::where('type', 'mistakes')->where('projects',$id)->get();
        $numberLabels = Label::where('type', 'number')->where('projects',$id)->get();
        $requirementsLabels = Label::where('type', 'requirements')->where('projects',$id)->get();
        return view('pag.mental', compact('tasks','ideaLabels','mistakesLabels','numberLabels','requirementsLabels'));
    }

    public function storeTask(Request $request, Project $project)
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

    public function destroyTask(Task $task)
    {
        $task->delete();

        return response()->json(['success' => true]);
    }

    public function storeLabel(Request $request)
    {
        $label = new Label;
        $label->text = $request->input('text');
        $label->projects = session()->get('projects');
        $label->type = $request->input('type');
        $label->data_x = $request->input('data_x');
        $label->data_y = $request->input('data_y');
        $label->save();
        return response()->json(['id' => $label->id]);
    }
public function destroyLabel(Label $label)
{
    $label->delete();

    return response()->json(['success' => true]);
}

public function updateLabelPosition(Request $request, Label $label)
{
    $label->data_x = $request->input('data_x');
    $label->data_y = $request->input('data_y');
    $label->save();

    return response()->json(['success' => true]);
}

public function getLabelsByType($type)
{
    $labels = Label::where('type', $type)->get();
    return response()->json($labels);
}


public function all()
{
    $labels = Label::where('type', $type)->where('projects',$lang)->get();
        return view('pag.mental', compact('tasks'));

    // return response()->json($labels);
}






}
