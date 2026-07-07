<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'department_id',
        'leader_id',
        'description',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function leader()
    {
        return $this->belongsTo(Employee::class, 'leader_id');
    }

    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }
    public function tasks()
{
    return $this->hasMany(TeamTask::class);
}
}