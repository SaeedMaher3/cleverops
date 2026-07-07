<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ProjectTask;
use Illuminate\Http\Request;

class MyTaskController extends Controller
{
    public function index()
    {
        $employee = Employee::where('email', auth()->user()->email)->first();

        $tasks = collect();

        if ($employee) {

            $tasks = ProjectTask::with([
                    'project',
                    'employee',
                    'assignedBy'
                ])
                ->where('assigned_to', $employee->id)
                ->orderBy('due_date')
                ->get();

        }

        return view('my-tasks.index', compact('tasks'));
    }
}