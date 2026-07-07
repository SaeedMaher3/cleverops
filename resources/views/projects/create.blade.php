@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <h1 class="text-3xl font-extrabold text-slate-800 mb-6">
        Create Project
    </h1>

    <form action="{{ route('projects.store') }}" method="POST" class="page-card p-8 max-w-4xl">
        @csrf

        <div class="mb-4">
            <label>Project Name</label>
            <input name="name" class="w-full border rounded-xl p-3" required>
        </div>

        <div class="mb-4">
            <label>Description</label>
            <textarea name="description" class="w-full border rounded-xl p-3"></textarea>
        </div>

        <div class="mb-4">
            <label>Manager</label>
            <select name="manager_id" class="w-full border rounded-xl p-3">
                <option value="">Not assigned</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <input type="date" name="start_date" class="border rounded-xl p-3">
            <input type="date" name="deadline" class="border rounded-xl p-3">
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <select name="priority" class="border rounded-xl p-3" required>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>

            <select name="status" class="border rounded-xl p-3" required>
                <option value="active">Active</option>
                <option value="on_hold">On Hold</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <div class="grid grid-cols-3 gap-4 mt-4">
            <input type="number" name="progress" min="0" max="100" value="0" class="border rounded-xl p-3">
            <input type="number" name="budget" step="0.01" class="border rounded-xl p-3" placeholder="Budget">
            <input type="color" name="color" value="#7C3AED" class="border rounded-xl p-3 h-12">
        </div>

        <button class="btn-primary mt-6">
            Save Project
        </button>
    </form>

</div>
@endsection