@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Create Team Task</h1>
        <p class="text-slate-500 text-sm">Assign a task to a team member</p>
    </div>

    <div class="page-card p-6 max-w-3xl">

        <form method="POST" action="{{ route('team-tasks.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-medium">Team</label>
                <select name="team_id" class="w-full border rounded-lg p-3" required>
                    <option value="">Select Team</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Assign To</label>
                <select name="employee_id" class="w-full border rounded-lg p-3" required>
                    <option value="">Select Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Task Title</label>
                <input type="text" name="title" class="w-full border rounded-lg p-3" required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Priority</label>
                <select name="priority" class="w-full border rounded-lg p-3" required>
                    <option value="low">Low</option>
                    <option value="medium" selected>Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Status</label>
                <select name="status" class="w-full border rounded-lg p-3" required>
                    <option value="todo">To Do</option>
                    <option value="in_progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Due Date</label>
                <input type="date" name="due_date" class="w-full border rounded-lg p-3">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">Description</label>
                <textarea name="description" rows="4" class="w-full border rounded-lg p-3"></textarea>
            </div>

            <button class="btn-primary">
                Create Task
            </button>

            <a href="{{ route('team-tasks.index') }}" class="ml-3 text-slate-600 font-medium">
                Back
            </a>

        </form>

    </div>

</div>
@endsection