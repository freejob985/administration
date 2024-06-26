<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    use HasFactory;
    protected $table = 'schedule'; // تحديد اسم الجدول هنا

    protected $fillable = ['name', 'project_id','task_id', 'type','priority','status','background'];
    public $timestamps = false;
}
