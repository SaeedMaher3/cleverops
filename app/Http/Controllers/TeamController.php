<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with(['department', 'leader'])
            ->latest()
            ->paginate(10);

        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        $departments = Department::all();
        $employees = Employee::all();

        return view('teams.create', compact('departments', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|max:255',
            'department_id' => 'required',
            'leader_id'     => 'nullable',
            'description'   => 'nullable',
            'status'        => 'required',
        ]);

        Team::create($request->all());

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team created successfully.');
    }

    public function show(Team $team)
    {
        $team->load(['department', 'leader', 'members.employee']);

        $employees = Employee::whereDoesntHave('teamMemberships', function ($query) use ($team) {
            $query->where('team_id', $team->id);
        })->get();

        return view('teams.show', compact('team', 'employees'));
    }

    public function edit(Team $team)
    {
        $departments = Department::all();
        $employees = Employee::all();

        return view('teams.edit', compact('team', 'departments', 'employees'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name'          => 'required|max:255',
            'department_id' => 'required',
            'leader_id'     => 'nullable',
            'description'   => 'nullable',
            'status'        => 'required',
        ]);

        $team->update($request->all());

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team updated successfully.');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team deleted successfully.');
    }
}