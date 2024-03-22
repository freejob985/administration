<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class taskController extends Controller
{
    public function task()
    {
        return view('pag.task'); // عرض البيانات في العرض المناسب
    }
}
