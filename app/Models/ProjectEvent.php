<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectEvent extends Model
{
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'event_date',
        'event_time',
        'type',
        'color',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}