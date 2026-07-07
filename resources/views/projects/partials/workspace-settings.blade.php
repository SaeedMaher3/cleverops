<div class="settings-grid">

    <div class="panel-card">
        <h2>Project Settings</h2>
        <p class="muted">Manage project information, visibility, and workspace preferences.</p>

        <div class="settings-list">

            <div class="setting-item">
                <div>
                    <strong>Project Name</strong>
                    <span>{{ $project->name }}</span>
                </div>
                <a href="{{ route('projects.edit', $project) }}">Edit</a>
            </div>

            <div class="setting-item">
                <div>
                    <strong>Status</strong>
                    <span>{{ ucfirst($project->status) }}</span>
                </div>
                <a href="{{ route('projects.edit', $project) }}">Change</a>
            </div>

            <div class="setting-item">
                <div>
                    <strong>Priority</strong>
                    <span>{{ ucfirst($project->priority) }}</span>
                </div>
                <a href="{{ route('projects.edit', $project) }}">Change</a>
            </div>

            <div class="setting-item">
                <div>
                    <strong>Deadline</strong>
                    <span>{{ $project->deadline ?? 'Not set' }}</span>
                </div>
                <a href="{{ route('projects.edit', $project) }}">Update</a>
            </div>

        </div>
    </div>

    <div class="panel-card danger-zone">
        <h2>Danger Zone</h2>
        <p class="muted">Deleting this project will remove its workspace data.</p>

        <form method="POST" action="{{ route('projects.destroy', $project) }}"
              onsubmit="return confirm('Are you sure you want to delete this project?')">
            @csrf
            @method('DELETE')

            <button type="submit" class="danger-btn">
                Delete Project
            </button>
        </form>
    </div>

</div>