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
    public function show(Subtask $subtask)
    {
        //
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
    public function update(Request $request, Subtask $subtask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subtask $subtask)
    {
        //
    }
}
