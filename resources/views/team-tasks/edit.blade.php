@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Edit Team Task</h1>
        <p class="text-slate-500 text-sm">Update team task information</p>
    </div>

    <div class="page-card p-6 max-w-3xl">

        <form method="POST" action="{{ route('team-tasks.update', $teamTask) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2 font-medium">Team</label>
                <select name="team_id" class="w-full border rounded-lg p-3" required>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ $teamTask->team_id == $team->id ? 'selected' : '' }}>
                            {{ $team->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Assign To</label>
                <select name="employee_id" class="w-full border rounded-lg p-3" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $teamTask->employee_id == $employee->id ? 'selected' : '' }}>
                            {{ $employee->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Task Title</label>
                <input type="text" name="title" value="{{ $teamTask->title }}" class="w-full border rounded-lg p-3" required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Priority</label>
                <select name="priority" class="w-full border rounded-lg p-3">
                    <option value="low" {{ $teamTask->priority == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $teamTask->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ $teamTask->priority == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Status</label>
                <select name="status" class="w-full border rounded-lg p-3">
                    <option value="todo" {{ $teamTask->status == 'todo' ? 'selected' : '' }}>To Do</option>
                    <option value="in_progress" {{ $teamTask->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ $teamTask->status == 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Due Date</label>
                <input type="date" name="due_date" value="{{ $teamTask->due_date }}" class="w-full border rounded-lg p-3">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">Description</label>
                <textarea name="description" rows="4" class="w-full border rounded-lg p-3">{{ $teamTask->description }}</textarea>
            </div>

            <button class="btn-primary">Update Task</button>

            <a href="{{ route('team-tasks.index') }}" class="ml-3 text-slate-600 font-medium">
                Back
            </a>
        </form>

    </div>

</div>
@endsection