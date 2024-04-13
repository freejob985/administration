<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'content',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
