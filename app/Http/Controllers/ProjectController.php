<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

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

    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();

        return response()->json(['success' => true]);
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }
}
