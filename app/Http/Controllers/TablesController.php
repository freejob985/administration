<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\schedule;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    //


public function Tables($id)
{

        $schedule = schedule::where('project_id', $id)->get();
        return view('pag.Tables',compact('schedule'));
    // return response()->json($labels);
}


}
