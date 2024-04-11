<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string',
        'condition' => 'required|boolean', // الحقل من نوع boolean
        'task_id' => 'required|exists:schedule,id',
    ]);

    $validatedData['condition'] = (int) $validatedData['condition']; // تحويل القيمة إلى integer

    $subtask = Subtask::create($validatedData);

    return response()->json($subtask, 201);
}

    /**
     * Display the specified resource.
     */
public function show($taskId)
{
    $subtasks = Subtask::where('task_id', $taskId)->get();
    return response()->json($subtasks);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subtask $subtask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $subtask = Subtask::findOrFail($id);
    $subtask->condition = $request->input('condition') ? 1 : 0; // Convert to integer
    $subtask->save();
    return response()->json($subtask);
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $subtask = Subtask::findOrFail($id);
    $subtask->delete();
    return response()->json(['message' => 'تم حذف التاسك الفرعي بنجاح']);
}



}
