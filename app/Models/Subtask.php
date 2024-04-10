<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    use HasFactory;
  protected $fillable = ['name', 'condition', 'task_id'];

  public function task()
  {
  return $this->belongsTo(Schedule::class);
  }
}