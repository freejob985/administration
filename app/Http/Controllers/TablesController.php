<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Table;
use App\Models\schedule;
use session;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    //


    public function Tables($id)
    {
        session()->put('projects', $id);

        $schedule = schedule::where('project_id', $id)->where('type',"Basic")->get();
        $Table = Table::where('project_id', $id)->get();

        return view('pag.Tables', compact('schedule', 'Table','id'));
        // return response()->json($labels);
    }
    public function store(Request $request)
    {

        $table = Table::create([
            'name' => $request->input('name'),
            'color' => $request->input('color'),
            'project_id' => session()->get('projects'),
        ]);



        return response()->json($table);
    }

    public function destroy(Table $table)
    {
        $table->delete();
        return response()->json(['message' => 'Table deleted successfully']);
    }

public function update(Request $request, Schedule $schedule)
{
$schedule->update([
'priority' => $request->input('priority'),
'status' => $request->input('status'),
]);

return response()->json($schedule);
}

   public function updateType(Request $request, Schedule $schedule)
   {
   $schedule->update([
   'type' => $request->input('type'),
   ]);

   return response()->json($schedule);
   }


}
