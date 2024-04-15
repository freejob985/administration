<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Console\Scheduling\Schedule;
use DB;
class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('tasks')->get();
        return view('projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $project = new Project;
        $project->name = $request->input('name');
        $project->save();

        return redirect()->back()->with('success', 'Project added successfully!');
    }



public function del($id){
    Task::where('project_id', $id)->delete();

    Schedule::where('project_id', $id)->delete();
}
public function destroy($id)
{
    // حذف المشروع من الجدول "Project"
    $project = Project::find($id);
    $project->delete();

    // حذف السجلات من جدول "tasks" حيث "project_id" يساوي "id" المشروع المحذوف من الجدول "Project"
    Task::where('project_id', $id)->delete();

    // حذف السجلات من جدول "schedule" حيث "project_id" يساوي "id" المشروع المحذوف من الجدول "Project"
    DB::table('schedule')->where('project_id', $id)->delete();
    DB::table('labels')->where('projects', $id)->delete();



    return response()->json(['success' => true]);
}



    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }
}
