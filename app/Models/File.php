<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'schedule_id',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
