<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $table = 'model'; // تحديد اسم الجدول هنا

    protected $fillable = ['name', 'color','project_id'];
    public $timestamps = false;


}
