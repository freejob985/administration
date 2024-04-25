<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notepad extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notepads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'details',
         'file',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

public function project()
{
    return $this->belongsTo(Project::class);
}

}
