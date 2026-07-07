@php
    $total = $projectTasks->count();

    $todo = $projectTasks->where('status', 'todo')->count();
    $progress = $projectTasks->where('status', 'in_progress')->count();
    $review = $projectTasks->where('status', 'review')->count();
    $done = $projectTasks->where('status', 'done')->count();

    $completion = $total ? round(($done / $total) * 100) : 0;

    $lateTasks = $projectTasks->filter(function ($task) {
        return $task->deadline &&
               \Carbon\Carbon::parse($task->deadline)->isPast() &&
               $task->status != 'done';
    });

    $upcoming = $projectTasks->filter(function ($task) {
        return $task->deadline &&
               \Carbon\Carbon::parse($task->deadline)->isFuture();
    })->sortBy('deadline')->take(5);
@endphp

<div class="reports-grid">

    <div class="report-card">
        <span>Total Tasks</span>
        <h2>{{ $total }}</h2>
    </div>

    <div class="report-card green">
        <span>Completed</span>
        <h2>{{ $done }}</h2>
    </div>

    <div class="report-card orange">
        <span>In Progress</span>
        <h2>{{ $progress }}</h2>
    </div>

    <div class="report-card red">
        <span>Late Tasks</span>
        <h2>{{ $lateTasks->count() }}</h2>
    </div>

</div>

<div class="panel-card">

    <div class="panel-title">
        <h2>Project Progress</h2>
        <strong>{{ $completion }}%</strong>
    </div>

    <div class="progress-bar-big">
        <div
            class="progress-fill"
            style="width:{{ $completion }}%">
        </div>
    </div>

</div>

<div class="reports-two-columns">

    <div class="panel-card">

        <h2>Task Distribution</h2>

        <div class="status-row">

            <div>
                <strong>{{ $todo }}</strong>
                <span>To Do</span>
            </div>

            <div>
                <strong>{{ $progress }}</strong>
                <span>In Progress</span>
            </div>

            <div>
                <strong>{{ $review }}</strong>
                <span>Review</span>
            </div>

            <div>
                <strong>{{ $done }}</strong>
                <span>Done</span>
            </div>

        </div>

    </div>

    <div class="panel-card">

        <h2>Upcoming Deadlines</h2>

        @forelse($upcoming as $task)

            <div class="deadline-item">

                <div>
                    <strong>{{ $task->title }}</strong>
                    <small>{{ $task->employee->full_name ?? 'Unassigned' }}</small>
                </div>

                <span>
                    {{ \Carbon\Carbon::parse($task->deadline)->format('d M') }}
                </span>

            </div>

        @empty

            <p class="muted">
                No upcoming deadlines.
            </p>

        @endforelse

    </div>

</div>

<div class="panel-card">

    <h2>Project Health</h2>

    @if($completion >= 80)

        <div class="health good">

            🟢 Excellent

        </div>

    @elseif($completion >= 50)

        <div class="health warning">

            🟡 Good Progress

        </div>

    @else

        <div class="health danger">

            🔴 Needs Attention

        </div>

    @endif

</div>