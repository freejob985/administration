<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Table;
use App\Models\schedule;
use session;
use Illuminate\Http\Request;
use DB;

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

public function update(Request $request)
{
   // Check if scheduleId is present in the request
   if ($request->has('scheduleId')) {
       // Find the schedule by the given ID
       $schedule = Schedule::find($request->input('scheduleId'));
       $taskId = $schedule->task_id;

       // Check if the schedule exists
       if ($schedule) {
           // Check if there is a value for priority in the request and update it
           if ($request->has('priority')) {
               $schedule->priority = $request->input('priority');
           }

           // Check if there is a value for status in the request and update it
           if ($request->has('status')) {
// dd(1);
               $status = $request->input('status');
               $schedule->status = $status;
// dd($status);
               if ($status === 'done') {
// dd(2);
                   DB::table('tasks')
                       ->where('id', $taskId)
                       ->update(['completed' => 1]);
               } else {
                   DB::table('tasks')
                       ->where('id', $taskId)
                       ->update(['completed' => 0]);
               }
           }

           // Save the changes
           $schedule->save();

           // Return the updated schedule as JSON
           return response()->json($schedule);
       } else {
           // If the requested schedule is not found
           return response()->json(['message' => 'Schedule not found'], 404);
       }
   } else {
       // If no scheduleId is provided in the request
       return response()->json(['message' => 'Schedule ID is required'], 400);
   }
}



   public function updateType(Request $request, Schedule $schedule)
   {
// dd(

//  $request->all()
// );
   $schedule->update([
   'type' => $request->input('type') ?? "Basic",
   ]);

   return response()->json($schedule);
   }


}
