<?php

namespace App\Http\Controllers;

use App\Models\Notepad;
use Illuminate\Http\Request;
use session;


use Illuminate\Support\Facades\File; // Import the File facade
class NotepadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
// Controller
// Controller

public function showFile($filename)
{
    $filePath = public_path('Notepad/' . $filename);

    if (File::exists($filePath)) {
        $fileContent = File::get($filePath);
        return response($fileContent, 200, ['Content-Type' => 'text/plain']);
    }

    return response('File not found', 404);
}

public function index()
{
    try {
        $projectIds = session()->get('projects');

        $notepads = Notepad::where('project_id', $projectIds)->get();


        foreach ($notepads as $notepad) {
            $fileName = $notepad->file . '.txt';
            $filePath = public_path('Notepad/' . $fileName);

            if (File::exists($filePath)) {
                $fileContent = File::get($filePath);
                $notepad->details = $fileContent;
                $notepad->filePath = $filePath; // Add the file path to the notepad object
            } else {
                $notepad->filePath = null; // Set filePath to null if the file doesn't exist
            }
        }

        return response()->json($notepads);
    } catch (\Exception $e) {
        // Handle the exception here
        return response()->json(['error' => $e->getMessage()], 500);
    }
}




// ... other code ...

// ... other code ...

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'details' => 'required',
    ]);

    $random_number = rand(1, 55555555);
    $validated['project_id'] = session()->get('projects');
    $validated['file'] = "FILE" . $random_number;

    $notepad = Notepad::create($validated);

    // Create a file with the name $validated['file'].txt and write $validated['details'] to it
    $fileName = $validated['file'] . '.txt';
    $filePath = public_path('Notepad/' . $fileName);
    File::ensureDirectoryExists(dirname($filePath));
    File::put($filePath, $validated['details']);

    // Return the new notepad as a JSON response
    return response()->json($notepad);
}
    /**
     * Show the form for creating a new resource.
     */
    public function destroy($id)
    {
        $notepad = Notepad::findOrFail($id);
        $fileName = $notepad->file . '.txt';
        $filePath = public_path('Notepad/' . $fileName);

        // Delete the associated file
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Delete the database record
        $notepad->delete();

        return response()->json([
            'message' => 'Notepad deleted successfully',
            'file' => $notepad->file
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $notepad = Notepad::findOrFail($id);
    $notepad->details = $request->input('details');
    $notepad->save();

    $fileName = $notepad->file . '.txt';
    $filePath = public_path('Notepad/' . $fileName);
    File::put($filePath, $notepad->details);

    return response()->json(['message' => 'Notepad updated successfully']);
}

    /**
     * Remove the specified resource from storage.
     */

}
