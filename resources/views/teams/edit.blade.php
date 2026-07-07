@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Edit Team</h1>
        <p class="text-slate-500 text-sm">Update team information</p>
    </div>

    <div class="page-card p-6 max-w-3xl">

        <form method="POST" action="{{ route('teams.update', $team) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2 font-medium">Team Name</label>
                <input type="text" name="name" value="{{ $team->name }}" class="w-full border rounded-lg p-3" required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Department</label>
                <select name="department_id" class="w-full border rounded-lg p-3" required>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ $team->department_id == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Team Leader</label>
                <select name="leader_id" class="w-full border rounded-lg p-3">
                    <option value="">Select Leader</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $team->leader_id == $employee->id ? 'selected' : '' }}>
                            {{ $employee->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Status</label>
                <select name="status" class="w-full border rounded-lg p-3">
                    <option value="active" {{ $team->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $team->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">Description</label>
                <textarea name="description" rows="4" class="w-full border rounded-lg p-3">{{ $team->description }}</textarea>
            </div>

            <button class="btn-primary">Update Team</button>

            <a href="{{ route('teams.index') }}" class="ml-3 text-slate-600 font-medium">
                Back
            </a>
        </form>

    </div>

</div>
@endsection