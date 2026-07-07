<div id="createTaskModal" class="create-task-modal">
    <div class="create-task-box">
        <button class="modal-close" onclick="closeCreateTaskModal()">×</button>

        <h2>Create New Task</h2>
        <p class="modal-subtitle">Assign work to your team inside this project.</p>

        <form action="{{ route('project-tasks.store') }}" method="POST">
            @csrf

            <input type="hidden" name="project_id" value="{{ $project->id }}">

            <label>Task Title</label>
            <input type="text" name="title" placeholder="Example: Build login API" required>

            <label>Description</label>
            <textarea name="description" rows="4" placeholder="Write task details..."></textarea>

            <div class="modal-grid">
                <div>
                    <label>Status</label>
                    <select name="status">
                        <option value="todo">To Do</option>
                        <option value="in_progress">In Progress</option>
                        <option value="review">Review</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <div>
                    <label>Priority</label>
                    <select name="priority">
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
            </div>

            <label>Assign To</label>
            <select name="assigned_to">
                <option value="">Unassigned</option>

                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">
                        {{ $employee->full_name }}
                    </option>
                @endforeach
            </select>

            <label>Due Date</label>
            <input type="date" name="due_date">

            <div class="modal-actions">
                <button type="button" class="cancel-btn" onclick="closeCreateTaskModal()">
                    Cancel
                </button>

                <button type="submit" class="create-btn">
                    Create Task
                </button>
            </div>
        </form>
    </div>
</div>

<div id="createTaskOverlay" class="create-task-overlay" onclick="closeCreateTaskModal()"></div>