<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamTask extends Model
{
    protected $fillable = [
        'team_id',
        'employee_id',
        'title',
        'description',
        'priority',
        'status',
        'due_date',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}