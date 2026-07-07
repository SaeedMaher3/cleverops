<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'manager_id',
        'start_date',
        'deadline',
        'priority',
        'status',
        'progress',
        'budget',
        'color',
    ];

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_user')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function projectTasks()
    {
        return $this->hasMany(ProjectTask::class);
    }

    public function messages()
    {
        return $this->hasMany(ProjectMessage::class)->latest();
    }

    public function projectFiles()
    {
        return $this->hasMany(ProjectFile::class);
    }

    public function projectEvents()
    {
        return $this->hasMany(ProjectEvent::class);
    }
}