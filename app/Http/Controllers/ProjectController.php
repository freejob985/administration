<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;


class ProjectController extends Controller
{
 /**
     * Display a listing of the projects.
     */
    // public function index()
    // {
    //     $projects = Project::all();
    //     return view('projects.index', compact('projects'));
    // }

   public function task()
    {
  $projects = Project::with('tasks')->get();
    return view('projects.index', compact('projects'));
    }

    /**
     * Store a newly created project in the database.
     */
    public function store(Request $request)
    {
        $project = new Project;
        $project->name = $request->input('name');
        $project->save();

        return redirect()->back()->with('success', 'Project added successfully!');
    }

    /**
     * Remove the specified project from the database.
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();

        return response()->json(['success' => true]);
    }
}
