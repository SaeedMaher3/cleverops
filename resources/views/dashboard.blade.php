@extends('layouts.app')

@section('content')

@php
    $departments = \App\Models\Department::withCount('employees')->take(5)->get();
    $recentEmployees = \App\Models\Employee::with(['department', 'user.role'])->latest()->take(6)->get();

    $projectsCount = \App\Models\Project::count();
    $activeProjects = \App\Models\Project::where('status', 'active')->count();

    $completedTasks = \App\Models\Task::where('status','completed')->count();
    $inProgressTasks = \App\Models\Task::where('status','in_progress')->count();
    $pendingTasks = \App\Models\Task::where('status','pending')->count();

    $completionRate = $tasksCount > 0 ? round(($completedTasks / $tasksCount) * 100) : 0;

    $colors = ['#7A00F5', '#17BFE3', '#F72575', '#F5B800', '#22C55E'];
@endphp

<div class="dash-page">

    <div class="dash-header">
        <div>
            <span class="dash-eyebrow">CleverOps Control Center</span>
            <h1>Dashboard</h1>
            <p>
                Welcome back,
                <strong>{{ Auth::user()->name }}</strong> 👋
                here is today’s company overview.
            </p>
        </div>

     @php
    $roleName = strtolower(auth()->user()->role?->name ?? '');

    $canManageProjects = in_array($roleName, [
        'super admin',
        'admin',
        'team leader'
    ]);

    $canManageEmployees = in_array($roleName, [
        'super admin',
        'admin',
        'hr manager'
    ]);
@endphp

<div class="dash-header-actions">

    @if($canManageProjects)
        <a href="{{ route('projects.create') }}" class="dash-main-btn">
            + New Project
        </a>
    @endif

    @if($canManageEmployees)
        <a href="{{ route('employees.create') }}" class="dash-soft-btn">
            + Add Employee
        </a>
    @endif

</div>
    </div>

    <div class="dash-stats-grid">

        <div class="dash-stat-card purple">
            <div class="dash-stat-icon"><i class="fa-solid fa-users"></i></div>
            <div>
                <p>Total Employees</p>
                <h2>{{ $employeesCount }}</h2>
                <span>Company workforce</span>
            </div>
        </div>

        <div class="dash-stat-card cyan">
            <div class="dash-stat-icon"><i class="fa-solid fa-building"></i></div>
            <div>
                <p>Departments</p>
                <h2>{{ $departmentsCount }}</h2>
                <span>Active structure</span>
            </div>
        </div>

        <div class="dash-stat-card orange">
            <div class="dash-stat-icon"><i class="fa-solid fa-diagram-project"></i></div>
            <div>
                <p>Projects</p>
                <h2>{{ $projectsCount }}</h2>
                <span>{{ $activeProjects }} active projects</span>
            </div>
        </div>

        <div class="dash-stat-card pink">
            <div class="dash-stat-icon"><i class="fa-solid fa-list-check"></i></div>
            <div>
                <p>Total Tasks</p>
                <h2>{{ $tasksCount }}</h2>
                <span>{{ $completionRate }}% completed</span>
            </div>
        </div>

    </div>

    <div class="dash-main-grid">

        <div class="dash-hero-card">
            <div class="hero-content">
                <div class="hero-logo-wrap">
                    <img src="{{ asset('images/logo (3).png') }}" alt="Logo">
                </div>

                <div class="hero-text">
                    <span class="hero-badge">● System Online</span>
                    <h2>Welcome to <br><span>Clever Mind POB</span></h2>
                    <p>
                        A smart internal operations platform for teams, departments,
                        projects, tasks, documents and company workflow.
                    </p>

                    <div class="hero-mini-grid">
                        <div>
                            <b>{{ $projectsCount }}</b>
                            <span>Projects</span>
                        </div>
                        <div>
                            <b>{{ $employeesCount }}</b>
                            <span>Employees</span>
                        </div>
                        <div>
                            <b>{{ $completionRate }}%</b>
                            <span>Completion</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-card-head">
                <div>
                    <span class="card-icon purple-bg"><i class="fa-solid fa-chart-pie"></i></span>
                    <h3>Employees by Department</h3>
                </div>
                <small>This Month</small>
            </div>

            <div class="department-layout">
                <div class="donut">
                    <div class="donut-inner">
                        <i class="fa-solid fa-users"></i>
                        <b>{{ $employeesCount }}</b>
                        <span>Total</span>
                    </div>
                </div>

                <div class="department-list">
                    @forelse($departments as $index => $department)
                        @php
                            $percentage = $employeesCount > 0 ? round(($department->employees_count / $employeesCount) * 100) : 0;
                            $color = $colors[$index] ?? '#7A00F5';
                        @endphp

                        <div class="department-item">
                            <div class="department-info">
                                <span style="background: {{ $color }}"></span>
                                <p>{{ $department->name }}</p>
                                <b>{{ $percentage }}%</b>
                            </div>
                            <div class="department-bar">
                                <div style="width: {{ $percentage }}%; background: {{ $color }}"></div>
                            </div>
                        </div>
                    @empty
                        <p class="empty-text">No departments yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <div class="dash-bottom-grid">

        <div class="dash-card">
            <div class="dash-card-head">
                <div>
                    <span class="card-icon cyan-bg"><i class="fa-solid fa-user-group"></i></span>
                    <h3>Recent Employees</h3>
                </div>
                <a href="{{ route('employees.index') }}">View all</a>
            </div>

            <div class="employee-list">
                @forelse($recentEmployees as $employee)
                    <div class="employee-row">
                        <div class="employee-left">
                            <div class="employee-avatar">
                                {{ strtoupper(substr($employee->full_name, 0, 1)) }}
                                <span></span>
                            </div>
                            <div>
                                <h4>{{ $employee->full_name }}</h4>
                                <p>{{ $employee->job_title ?? 'Employee' }} · {{ $employee->department->name ?? '-' }}</p>
                            </div>
                        </div>

                        <span class="role-pill">
                            {{ $employee->user?->role?->display_name ?? 'No Account' }}
                        </span>
                    </div>
                @empty
                    <p class="empty-text">No employees yet.</p>
                @endforelse
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-card-head">
                <div>
                    <span class="card-icon pink-bg"><i class="fa-solid fa-chart-simple"></i></span>
                    <h3>Tasks Overview</h3>
                </div>
                <a href="{{ route('tasks.index') }}">View all</a>
            </div>

            <div class="task-overview">
                <div class="task-ring">
                    <div>
                        <b>{{ $tasksCount }}</b>
                        <span>Total Tasks</span>
                    </div>
                </div>

                <div class="task-status-list">
                    <div><span>✅ Completed</span><b>{{ $completedTasks }}</b></div>
                    <div><span>🕒 In Progress</span><b>{{ $inProgressTasks }}</b></div>
                    <div><span>⏳ Pending</span><b>{{ $pendingTasks }}</b></div>
                    <div><span>🚨 Overdue</span><b>0</b></div>
                </div>
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-card-head">
                <div>
                    <span class="card-icon orange-bg"><i class="fa-solid fa-bolt"></i></span>
                    <h3>Quick Actions</h3>
                </div>
            </div>

            <div class="quick-actions-grid">
                <a href="{{ route('employees.create') }}" class="quick-action">
                    <i class="fa-solid fa-user-plus"></i>
                    <b>Add Employee</b>
                    <span>Create employee profile</span>
                </a>

                <a href="{{ route('departments.create') }}" class="quick-action">
                    <i class="fa-solid fa-building"></i>
                    <b>Add Department</b>
                    <span>Organize company teams</span>
                </a>

                <a href="{{ route('tasks.create') }}" class="quick-action">
                    <i class="fa-solid fa-list-check"></i>
                    <b>Add Task</b>
                    <span>Create work assignment</span>
                </a>

                <a href="{{ route('roles.create') }}" class="quick-action">
                    <i class="fa-solid fa-shield-halved"></i>
                    <b>Add Role</b>
                    <span>Manage permissions</span>
                </a>
            </div>
        </div>

    </div>

    <div class="dash-final-grid">

        <div class="dash-card">
            <div class="dash-card-head">
                <div>
                    <span class="card-icon green-bg"><i class="fa-solid fa-wave-square"></i></span>
                    <h3>Today’s Summary</h3>
                </div>
            </div>

            <div class="summary-grid">
                <div>
                    <b>{{ $completedTasks }}</b>
                    <span>Completed Tasks</span>
                </div>
                <div>
                    <b>{{ $inProgressTasks }}</b>
                    <span>Running Tasks</span>
                </div>
                <div>
                    <b>{{ $pendingTasks }}</b>
                    <span>Pending Tasks</span>
                </div>
                <div>
                    <b>{{ $activeProjects }}</b>
                    <span>Active Projects</span>
                </div>
            </div>
        </div>

        <div class="dash-quote-card">
            <span>“</span>
            <p>
                Great teams don’t just work, they believe, collaborate and achieve together.
            </p>
            <b>– Clever Mind POB</b>
        </div>

    </div>

</div>

@endsection