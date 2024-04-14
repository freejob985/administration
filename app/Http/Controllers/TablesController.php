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

public function update(Request $request)
{
    // التحقق من وجود scheduleId في الطلب
    if ($request->has('scheduleId')) {
        // العثور على الجدول بالرقم المحدد
        $schedule = Schedule::find($request->input('scheduleId'));

        // التحقق من وجود الجدول
        if ($schedule) {
            // التحقق مما إذا كانت هناك قيمة لأولوية في الطلب وتحديثها
            if ($request->has('priority')) {
                $schedule->priority = $request->input('priority');
            }

            // التحقق مما إذا كانت هناك قيمة لحالة في الطلب وتحديثها
            if ($request->has('status')) {
                $schedule->status = $request->input('status');
            }

            // حفظ التغييرات
            $schedule->save();

            // إرجاع الجدول المحدث كـ JSON
            return response()->json($schedule);
        } else {
            // إذا لم يتم العثور على الجدول المطلوب
            return response()->json(['message' => 'Schedule not found'], 404);
        }
    } else {
        // إذا لم يتم إرسال معرف الجدول (scheduleId)
        return response()->json(['message' => 'Schedule ID is required'], 400);
    }
}



   public function updateType(Request $request, Schedule $schedule)
   {
   $schedule->update([
   'type' => $request->input('type') ?? "Basic",
   ]);

   return response()->json($schedule);
   }


}
