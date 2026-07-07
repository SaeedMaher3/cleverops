<?php

namespace App\Http\Controllers;

use App\Models\TeamTask;
use App\Models\Team;
use App\Models\Employee;
use Illuminate\Http\Request;

class TeamTaskController extends Controller
{
    public function index()
    {
        $tasks = TeamTask::with(['team', 'employee'])
            ->latest()
            ->paginate(10);

        return view('team-tasks.index', compact('tasks'));
    }

    public function create()
    {
        $teams = Team::all();
        $employees = Employee::all();

        return view('team-tasks.create', compact(
            'teams',
            'employees'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required',
            'employee_id' => 'required',
            'title' => 'required|max:255',
            'priority' => 'required',
            'status' => 'required',
        ]);

        TeamTask::create($request->all());

        return redirect()
            ->route('team-tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function show(TeamTask $teamTask)
    {
        return view('team-tasks.show', compact('teamTask'));
    }

    public function edit(TeamTask $teamTask)
    {
        $teams = Team::all();
        $employees = Employee::all();

        return view('team-tasks.edit', compact(
            'teamTask',
            'teams',
            'employees'
        ));
    }

    public function update(Request $request, TeamTask $teamTask)
    {
        $request->validate([
            'team_id' => 'required',
            'employee_id' => 'required',
            'title' => 'required|max:255',
            'priority' => 'required',
            'status' => 'required',
        ]);

        $teamTask->update($request->all());

        return redirect()
            ->route('team-tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(TeamTask $teamTask)
    {
        $teamTask->delete();

        return redirect()
            ->route('team-tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}