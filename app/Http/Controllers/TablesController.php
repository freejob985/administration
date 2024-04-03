<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablesController extends Controller
{
    //


public function Tables()
{

        return view('pag.Tables');

    // return response()->json($labels);
}


}
