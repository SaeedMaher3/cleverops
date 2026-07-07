@extends('layouts.app')

@section('content')

<style>
.project-edit-page{
    padding:32px;
}

.project-edit-card{
    max-width:850px;
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:28px;
    padding:32px;
    box-shadow:0 18px 45px rgba(15,23,42,.07);
}

.project-edit-header{
    margin-bottom:26px;
}

.project-edit-header span{
    color:#7c3aed;
    font-weight:900;
    font-size:13px;
}

.project-edit-header h1{
    margin:8px 0 6px;
    font-size:32px;
    font-weight:900;
    color:#111827;
}

.project-edit-header p{
    margin:0;
    color:#64748b;
}

.project-form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
}

.project-form-group.full{
    grid-column:1 / -1;
}

.project-form-group label{
    display:block;
    font-weight:900;
    color:#334155;
    margin-bottom:8px;
}

.project-form-group input,
.project-form-group textarea,
.project-form-group select{
    width:100%;
    border:1px solid #e5e7eb;
    background:#f8fafc;
    border-radius:16px;
    padding:13px 15px;
    outline:none;
    font-weight:700;
    color:#0f172a;
}

.project-form-group textarea{
    min-height:110px;
    resize:vertical;
}

.project-form-group input:focus,
.project-form-group textarea:focus,
.project-form-group select:focus{
    border-color:#7c3aed;
    background:#fff;
    box-shadow:0 0 0 4px rgba(124,58,237,.12);
}

.project-edit-actions{
    display:flex;
    justify-content:flex-end;
    gap:12px;
    margin-top:26px;
}

.project-edit-actions a,
.project-edit-actions button{
    border:none;
    border-radius:16px;
    padding:13px 20px;
    font-weight:900;
    cursor:pointer;
    text-decoration:none;
}

.project-edit-actions a{
    background:#f1f5f9;
    color:#475569;
}

.project-edit-actions button{
    background:linear-gradient(135deg,#7c3aed,#4f46e5);
    color:#fff;
    box-shadow:0 12px 28px rgba(124,58,237,.28);
}
</style>

<div class="project-edit-page">

    <div class="project-edit-card">

        <div class="project-edit-header">
            <span>PROJECT SETTINGS</span>
            <h1>Edit Project</h1>
            <p>Update project details, status, priority and planning information.</p>
        </div>

        <form method="POST" action="{{ route('projects.update', $project) }}">
            @csrf
            @method('PUT')

            <div class="project-form-grid">

                <div class="project-form-group full">
                    <label>Project Name</label>
                    <input type="text" name="name" value="{{ old('name', $project->name) }}" required>
                </div>

                <div class="project-form-group full">
                    <label>Description</label>
                    <textarea name="description">{{ old('description', $project->description) }}</textarea>
                </div>

                <div class="project-form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="planning" {{ old('status', $project->status) == 'planning' ? 'selected' : '' }}>Planning</option>
                        <option value="active" {{ old('status', $project->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="on_hold" {{ old('status', $project->status) == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                        <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="project-form-group">
                    <label>Priority</label>
                    <select name="priority">
                        <option value="low" {{ old('priority', $project->priority) == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority', $project->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority', $project->priority) == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <div class="project-form-group">
                    <label>Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $project->start_date) }}">
                </div>

                <div class="project-form-group">
                    <label>Deadline</label>
                    <input type="date" name="deadline" value="{{ old('deadline', $project->deadline) }}">
                </div>

                <div class="project-form-group">
                    <label>Progress %</label>
                    <input type="number" name="progress" min="0" max="100" value="{{ old('progress', $project->progress ?? 0) }}">
                </div>

                <div class="project-form-group">
                    <label>Budget</label>
                    <input type="number" step="0.01" name="budget" value="{{ old('budget', $project->budget) }}">
                </div>

                <div class="project-form-group">
                    <label>Project Color</label>
                    <input type="color" name="color" value="{{ old('color', $project->color ?? '#7c3aed') }}">
                </div>

                <div class="project-form-group">
                    <label>Manager</label>
                    <select name="manager_id">
                        <option value="">Not assigned</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('manager_id', $project->manager_id) == $employee->id ? 'selected' : '' }}>
                                {{ $employee->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="project-edit-actions">
                <a href="{{ route('projects.show', $project) }}">Cancel</a>
                <button type="submit">Save Changes</button>
            </div>

        </form>

    </div>

</div>

@endsection