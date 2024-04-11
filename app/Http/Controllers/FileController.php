<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the files for a given task.
     *
     * @param  int  $scheduleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($scheduleId)
    {
        $files = File::where('schedule_id', $scheduleId)->get();
        return response()->json($files);
    }

    /**
     * Store a newly created file in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
     public function store(Request $request)
    {
// dd(
// $request->all()
// );
        $request->validate([
            'file' => 'required|file|max:5120', // 5MB max file size
            'schedule_id' => 'required|exists:schedule,id',
        ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $file->storeAs('public/files', $filename);

        $fileRecord = File::create([
            'filename' => $filename,
            'schedule_id' => $request->input('schedule_id'),
        ]);

        return response()->json($fileRecord);
    }
}
