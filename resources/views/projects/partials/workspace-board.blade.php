<div class="panel-card">
    <div class="panel-title">
        <h2>{{ $title ?? 'Board' }}</h2>

        @if($isAdmin || $isManager)
         @if($isAdmin)
    <button type="button" class="new-task-btn" onclick="openCreateTaskModal()">
        + New Task
    </button>
@endif
        @endif
    </div>

    <div class="kanban-board">
        @foreach($columns as $status => $label)
            <div class="kanban-column">
                <div class="kanban-column-header">
                    <h4>{{ $label }}</h4>
                    <span>{{ isset($tasks[$status]) ? $tasks[$status]->count() : 0 }}</span>
                </div>

                <div class="kanban-list" data-status="{{ $status }}">
                    @forelse($tasks[$status] ?? [] as $task)
                        <div class="kanban-task"
                             @if($isAdmin || $isManager) draggable="true" @endif
                             data-task-id="{{ $task->id }}"
                             data-title="{{ $task->title }}"
                             data-priority="{{ ucfirst($task->priority) }}"
                             data-assignee="{{ $task->employee->full_name ?? 'Unassigned' }}"
                             data-due="{{ $task->due_date ? $task->due_date->format('d M Y') : 'No due date' }}"
                             data-description="{{ $task->description ?? 'No description.' }}">

                            <div class="task-top">
                                <strong>{{ $task->title }}</strong>

                                @if($isAdmin || $isManager)
                                    <form action="{{ route('project-tasks.destroy', $task) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Delete task?')">×</button>
                                    </form>
                                @endif
                            </div>

                            <p>{{ $task->description ?? 'No description.' }}</p>

                            <div class="task-meta">
                                <span class="priority {{ $task->priority }}">
                                    {{ ucfirst($task->priority) }}
                                </span>

                                <span>
                                    {{ $task->employee->full_name ?? 'Unassigned' }}
                                </span>
                            </div>

                            @if($task->due_date)
                                <div class="due-date">
                                    📅 {{ $task->due_date->format('d M Y') }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="empty-column">
                            No tasks yet
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</div>