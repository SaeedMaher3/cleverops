@extends('layouts.app')

@section('content')



@php
    $projectTasks = $project->projectTasks ?? collect();
    $tasks = $projectTasks->groupBy('status');

    $totalTasks = $projectTasks->count();
    $completedTasks = $projectTasks->where('status', 'done')->count();

    $columns = [
        'todo' => 'To Do',
        'in_progress' => 'In Progress',
        'review' => 'Review',
        'done' => 'Done',
    ];
@endphp

<div class="workspace-page">

    <div class="workspace-header">
        <div>
            <div class="workspace-breadcrumb">CleverOps / Projects / Workspace</div>

            <h1>{{ $project->name }}</h1>

            <p>{{ $project->description ?? 'No description added for this project yet.' }}</p>

            <div class="workspace-badges">
                <span class="badge green">{{ ucfirst($project->status) }}</span>
                <span class="badge yellow">{{ ucfirst($project->priority) }} Priority</span>
                <span class="badge blue">Manager: {{ $project->manager->full_name ?? 'Not assigned' }}</span>
            </div>
        </div>

        <div class="workspace-progress">
            <div class="circle"
                 style="background: conic-gradient({{ $project->color ?? '#7C3AED' }} {{ $project->progress ?? 0 }}%, #e5e7eb 0);">
                <div>
                    <strong>{{ $project->progress ?? 0 }}%</strong>
                    <span>Completed</span>
                </div>
            </div>
        </div>
    </div>

  <div class="workspace-tabs">

    <a class="workspace-tab active" href="#" data-tab="overview">
        <i class="fa-solid fa-house"></i>
        <span>Overview</span>
    </a>

    <a class="workspace-tab" href="#" data-tab="board">
        <i class="fa-solid fa-table-columns"></i>
        <span>Board</span>
    </a>

    <a class="workspace-tab" href="#" data-tab="team">
        <i class="fa-solid fa-users"></i>
        <span>Team</span>
    </a>

    <a class="workspace-tab" href="#" data-tab="chat">
        <i class="fa-solid fa-comments"></i>
        <span>Chat</span>
    </a>

    <a class="workspace-tab" href="#" data-tab="files">
        <i class="fa-solid fa-folder-open"></i>
        <span>Files</span>
    </a>

    <a class="workspace-tab" href="#" data-tab="calendar">
        <i class="fa-solid fa-calendar-days"></i>
        <span>Calendar</span>
    </a>

    <a class="workspace-tab" href="#" data-tab="reports">
        <i class="fa-solid fa-chart-column"></i>
        <span>Reports</span>
    </a>

    @if($isAdmin)
    <a class="workspace-tab" href="#" data-tab="settings">
        <i class="fa-solid fa-gear"></i>
        <span>Settings</span>
    </a>
@endif

</div>

    <div class="workspace-tab-content active" id="overview">

        <div class="workspace-stats">
            <div class="stat-card">
                <span>📋</span>
                <div>
                    <h3>{{ $totalTasks }}</h3>
                    <p>Total Tasks</p>
                </div>
            </div>

            <div class="stat-card">
                <span>✅</span>
                <div>
                    <h3>{{ $completedTasks }}</h3>
                    <p>Completed</p>
                </div>
            </div>
<div class="stat-card">
    <span>👥</span>
    <div>
        <h3>{{ $project->members->count() }}</h3>
        <p>Members</p>
    </div>
</div>

            <div class="stat-card">
                <span>⏱️</span>
                <div>
                    <h3>0h</h3>
                    <p>Tracked Time</p>
                </div>
            </div>
        </div>

        <div class="workspace-content">
            <div class="main-panel">

                <div class="panel-card">
                    <div class="panel-title">
                        <h2>Project Overview</h2>
                       @if($isAdmin)
    <a href="{{ route('projects.edit', $project) }}">Edit Project</a>
@endif
                    </div>

                    <div class="overview-grid">
                        <div>
                            <span>Start Date</span>
                            <strong>{{ $project->start_date ?? 'Not set' }}</strong>
                        </div>

                        <div>
                            <span>Deadline</span>
                            <strong>{{ $project->deadline ?? 'Not set' }}</strong>
                        </div>

                        <div>
                            <span>Budget</span>
                            <strong>{{ $project->budget ? number_format($project->budget, 2) . ' JD' : 'Not set' }}</strong>
                        </div>

                        <div>
                            <span>Status</span>
                            <strong>{{ ucfirst($project->status) }}</strong>
                        </div>
                    </div>
                </div>

                @include('projects.partials.workspace-board', [
                    'columns' => $columns,
                    'tasks' => $tasks,
                    'title' => 'Kanban Board Preview'
                ])

            </div>

            <div class="side-panel">
                <div class="panel-card">
                    <h2>Team Members</h2>

                    <div class="avatar-list">
                        <div>S</div>
                        <div>A</div>
                        <div>M</div>
                        <div>+</div>
                    </div>

                    <p class="muted">Team assignment will be connected in the next step.</p>
                </div>

                <div class="panel-card">
                    <h2>Recent Activity</h2>

                    <div class="activity">
                        <p>Workspace created successfully.</p>
                        <p>Kanban Board connected to database.</p>
                        <p>Calendar connected to database.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="workspace-tab-content" id="board">
        @include('projects.partials.workspace-board', [
            'columns' => $columns,
            'tasks' => $tasks,
            'title' => 'Board'
        ])
    </div>

    <div class="workspace-tab-content" id="team">
        @include('projects.partials.workspace-team')
    </div>

    <div class="workspace-tab-content" id="chat">
        @include('projects.partials.workspace-chat')
    </div>

    <div class="workspace-tab-content" id="files">
        @include('projects.partials.workspace-files')
    </div>

    <div class="workspace-tab-content" id="calendar">
        @include('projects.partials.workspace-calendar', [
            'project' => $project,
            'projectTasks' => $projectTasks
        ])
    </div>

   <div class="workspace-tab-content" id="reports">
    @include('projects.partials.workspace-reports', [
        'project' => $project,
        'projectTasks' => $projectTasks,
        'columns' => $columns
    ])
</div>

   <div class="workspace-tab-content" id="settings">
    @include('projects.partials.workspace-settings', [
        'project' => $project
    ])
</div>
    </div>

</div>

@include('projects.partials.workspace-task-panel')

@if($isAdmin)
    @include('projects.partials.workspace-create-task-modal', [
        'project' => $project,
        'employees' => $employees
    ])
@endif

<script>
    window.projectWorkspace = {
        csrfToken: "{{ csrf_token() }}",
        statusUrlBase: "{{ url('/project-tasks') }}"
    };
</script>

@if(session('activeTab'))
<script>
    window.defaultWorkspaceTab = "{{ session('activeTab') }}";
</script>
@endif

<script src="{{ asset('js/project-workspace.js') }}"></script>

@endsection