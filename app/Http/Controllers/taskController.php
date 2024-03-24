<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class taskController extends Controller
{
    public function task()
    {
        return view('pag.task'); // عرض البيانات في العرض المناسب
    }

   public function mental()
    {
        return view('pag.mental'); // عرض البيانات في العرض المناسب
    }


public function notebook()
    {
        return view('pag.notebook'); // عرض البيانات في العرض المناسب
    }
}
