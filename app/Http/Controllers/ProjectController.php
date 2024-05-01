<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Task;
use App\Models\Project;
use App\Models\Subtask;
use Illuminate\Http\Request;
use Illuminate\Console\Scheduling\Schedule;

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
    $tasks = Task::where('project_id', $id)->get();
    foreach ($tasks as $task) {
        Subtask::where('task_id', $task->id)->delete();
    }
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

public function deleteData(Request $request)
{
    try {
        // إزالة قيود المفاتيح الأجنبية مؤقتًا
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableName = reset($table);
            DB::table($tableName)->truncate();
        }

        // إعادة تعيين قيود المفاتيح الأجنبية
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return response()->json(['message' => 'تم حذف جميع البيانات من جميع الجداول بنجاح.']);
    } catch (\Exception $e) {
        // إعادة تعيين قيود المفاتيح الأجنبية في حالة حدوث خطأ
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return response()->json(['error' => $e->getMessage()], 500);
    }
}


}
