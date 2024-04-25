<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class notepadcontroler extends Controller
{

   public function Notepad($id)
    {
session()->put('projects', $id);
        return view('pag.notepad', compact('id'));
    }
}
