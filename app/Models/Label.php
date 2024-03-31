<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    public $timestamps = false;

    protected $fillable = ['text','projects','type', 'data_x', 'data_y'];
}
