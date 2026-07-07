@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Team Details</h1>
        <p class="text-slate-500 text-sm">View team information and manage members</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="page-card p-6 max-w-5xl mb-6">

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <div class="text-sm text-slate-500">Team Name</div>
                <div class="font-bold text-lg">{{ $team->name }}</div>
            </div>

            <div>
                <div class="text-sm text-slate-500">Department</div>
                <div class="font-semibold">{{ $team->department->name ?? '-' }}</div>
            </div>

            <div>
                <div class="text-sm text-slate-500">Leader</div>
                <div class="font-semibold">{{ $team->leader->full_name ?? '-' }}</div>
            </div>

            <div>
                <div class="text-sm text-slate-500">Status</div>
                <div class="font-semibold">{{ ucfirst($team->status) }}</div>
            </div>
        </div>

        <div class="mb-6">
            <div class="text-sm text-slate-500 mb-2">Description</div>
            <div class="bg-slate-50 p-4 rounded-lg">
                {{ $team->description ?? 'No description available.' }}
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('teams.edit', $team) }}" class="btn-primary">
                Edit Team
            </a>

            <a href="{{ route('teams.index') }}" class="px-4 py-2 rounded bg-slate-200 text-slate-700">
                Back
            </a>
        </div>

    </div>

    <div class="page-card p-6 max-w-5xl mb-6">
        <h2 class="text-xl font-bold text-slate-800 mb-4">Add Member</h2>

        <form method="POST" action="{{ route('team-members.store') }}" class="flex gap-3">
            @csrf

            <input type="hidden" name="team_id" value="{{ $team->id }}">

            <select name="employee_id" class="flex-1 border rounded-lg p-3" required>
                <option value="">Select Employee</option>

                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">
                        {{ $employee->full_name }} - {{ $employee->job_title }}
                    </option>
                @endforeach
            </select>

            <button class="btn-primary">
                Add Member
            </button>
        </form>
    </div>

    <div class="page-card p-6 max-w-5xl">
        <h2 class="text-xl font-bold text-slate-800 mb-4">Team Members</h2>

        <table class="w-full">
            <thead class="bg-slate-100">
                <tr>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Job Title</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($team->members as $member)
                    <tr class="border-t">
                        <td class="px-4 py-3 font-semibold">
                            {{ $member->employee->full_name ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $member->employee->job_title ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $member->employee->email ?? '-' }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            <form method="POST" action="{{ route('team-members.destroy', $member) }}">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Remove this member?')"
                                        class="text-red-600 font-medium">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-slate-500">
                            No members added yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection