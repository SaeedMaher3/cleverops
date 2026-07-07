<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Employee;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required',
            'employee_id' => 'required',
        ]);

        $exists = TeamMember::where('team_id', $request->team_id)
            ->where('employee_id', $request->employee_id)
            ->exists();

        if (!$exists) {

            TeamMember::create([
                'team_id' => $request->team_id,
                'employee_id' => $request->employee_id,
            ]);
        }

        return back()->with(
            'success',
            'Member added successfully.'
        );
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return back()->with(
            'success',
            'Member removed successfully.'
        );
    }
}