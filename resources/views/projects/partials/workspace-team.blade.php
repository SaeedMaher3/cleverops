<div class="team-workspace">

    <div class="team-hero">
        <div>
            <span class="team-chip">Project Team</span>
            <h2>Team Members & Access</h2>
            <p>Manage who can access this project workspace.</p>
        </div>
    </div>

    @if($isAdmin || $isManager)
        <div class="team-card-large" style="margin-bottom:22px;">
            <div class="team-card-header">
                <div>
                    <h2>Add Project Member</h2>
                    <p>Select a user account to give workspace access.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('projects.members.add', $project) }}" style="display:flex; gap:12px; flex-wrap:wrap;">
                @csrf

                <select name="user_id" required style="flex:1; min-width:240px;">
                    <option value="">Choose user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->employee->full_name ?? $user->name }} - {{ $user->email }}
                        </option>
                    @endforeach
                </select>

                <select name="role" style="min-width:180px;">
                    <option value="member">Member</option>
                    <option value="leader">Team Leader</option>
                    <option value="manager">Manager</option>
                </select>

                <button type="submit" class="team-main-btn">+ Add Member</button>
            </form>
        </div>
    @endif

    <div class="team-stats-grid">
        <div class="team-stat-card">
            <div class="team-stat-icon">👑</div>
            <span>Project Manager</span>
            <h3>{{ $project->manager->full_name ?? 'Not assigned' }}</h3>
            <p>Responsible for planning and delivery.</p>
        </div>

        <div class="team-stat-card">
            <div class="team-stat-icon">👥</div>
            <span>Members</span>
            <h3>{{ $project->members->count() }} Members</h3>
            <p>Users who can access this workspace.</p>
        </div>

        <div class="team-stat-card">
            <div class="team-stat-icon">📋</div>
            <span>Assigned Tasks</span>
            <h3>{{ $totalTasks }}</h3>
            <p>Total tasks in this project.</p>
        </div>
    </div>

    <div class="team-card-large">
        <div class="team-card-header">
            <div>
                <h2>Team Members</h2>
                <p>Current users with access to this project workspace.</p>
            </div>
        </div>

        <div class="team-list">
            @forelse($project->members as $member)
                <div class="team-row">
                    <div class="team-avatar">
                        {{ strtoupper(substr($member->employee->full_name ?? $member->name, 0, 1)) }}
                    </div>

                    <div>
                        <h4>{{ $member->employee->full_name ?? $member->name }}</h4>
                        <p>{{ $member->email }}</p>
                    </div>

                    <div class="team-progress">
                        <span>{{ ucfirst($member->pivot->role ?? 'member') }}</span>
                        <div><b style="width:100%"></b></div>
                    </div>

                    @if($isAdmin || $isManager)
                        <form method="POST" action="{{ route('projects.members.remove', [$project, $member]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="team-main-btn"
                                    onclick="return confirm('Remove this member from project?')">
                                Remove
                            </button>
                        </form>
                    @else
                        <em class="online">Member</em>
                    @endif
                </div>
            @empty
                <p class="muted">No members added yet.</p>
            @endforelse
        </div>
    </div>

</div>