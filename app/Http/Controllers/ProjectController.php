<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Employee;
use App\Models\ProjectFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
public function index()
{
    $user = auth()->user();

    $isAdmin = $user->hasPermission('projects.view_all')
        || $user->hasRole('Super Admin')
        || $user->hasRole('Admin');

    if ($isAdmin) {
        $projects = Project::with('manager')
            ->latest()
            ->paginate(10);
    } else {
        $projects = Project::with('manager')
            ->whereHas('members', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })
            ->latest()
            ->paginate(10);
    }

    return view('projects.index', compact('projects'));
}
    public function create()
    {
        $employees = Employee::orderBy('full_name')->get();

        return view('projects.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable',
            'manager_id'  => 'nullable',
            'start_date'  => 'nullable|date',
            'deadline'    => 'nullable|date',
            'priority'    => 'required',
            'status'      => 'required',
            'progress'    => 'nullable|integer|min:0|max:100',
            'budget'      => 'nullable|numeric',
            'color'       => 'nullable|string|max:20',
        ]);

        $project = Project::create([
            'name'        => $request->name,
            'description' => $request->description,
            'manager_id'  => $request->manager_id,
            'start_date'  => $request->start_date,
            'deadline'    => $request->deadline,
            'priority'    => $request->priority,
            'status'      => $request->status,
            'progress'    => $request->progress ?? 0,
            'budget'      => $request->budget,
            'color'       => $request->color ?? '#4F46E5',
        ]);

        if ($project->manager?->user) {
            $project->members()->syncWithoutDetaching([
                $project->manager->user->id => [
                    'role' => 'manager',
                ],
            ]);
        }

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $user = auth()->user();

        $isAdmin = $user->hasRole('Super Admin') || $user->hasRole('Admin');

        $isManager = $project->manager?->user?->id === $user->id;

        $isMember = $project->members()
            ->where('users.id', $user->id)
            ->exists();

        if (! $isAdmin && ! $isManager && ! $isMember) {
            abort(403);
        }

        $project->load([
            'manager.user',
            'members.employee',
            'projectTasks.employee',
            'projectFiles.user',
            'messages.user',
            'projectEvents',
        ]);

        $employees = Employee::orderBy('full_name')->get();

        $users = User::with('employee')
            ->whereNotIn('id', $project->members()->pluck('users.id'))
            ->orderBy('name')
            ->get();

        $tasks = $project->projectTasks
            ->sortBy('position')
            ->groupBy('status');

        $messages = $project->messages
            ->sortBy('created_at');

        return view('projects.show', compact(
            'project',
            'employees',
            'users',
            'tasks',
            'messages',
            'isAdmin',
            'isManager'
        ));
    }

    public function edit(Project $project)
    {
        $employees = Employee::orderBy('full_name')->get();

        return view('projects.edit', compact('project', 'employees'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable',
            'manager_id'  => 'nullable',
            'start_date'  => 'nullable|date',
            'deadline'    => 'nullable|date',
            'priority'    => 'required',
            'status'      => 'required',
            'progress'    => 'nullable|integer|min:0|max:100',
            'budget'      => 'nullable|numeric',
            'color'       => 'nullable|string|max:20',
        ]);

        $project->update([
            'name'        => $request->name,
            'description' => $request->description,
            'manager_id'  => $request->manager_id,
            'start_date'  => $request->start_date,
            'deadline'    => $request->deadline,
            'priority'    => $request->priority,
            'status'      => $request->status,
            'progress'    => $request->progress ?? 0,
            'budget'      => $request->budget,
            'color'       => $request->color ?? '#4F46E5',
        ]);

        if ($project->manager?->user) {
            $project->members()->syncWithoutDetaching([
                $project->manager->user->id => [
                    'role' => 'manager',
                ],
            ]);
        }

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function addMember(Request $request, Project $project)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role'    => 'nullable|string|max:50',
        ]);

        $authUser = auth()->user();

        $isAdmin = $authUser->hasRole('Super Admin') || $authUser->hasRole('Admin');
        $isManager = $project->manager?->user?->id === $authUser->id;

        if (! $isAdmin && ! $isManager) {
            abort(403);
        }

        $project->members()->syncWithoutDetaching([
            $request->user_id => [
                'role' => $request->role ?? 'member',
            ],
        ]);

        return back()
            ->with('success', 'Member added successfully.')
            ->with('activeTab', 'team');
    }

    public function removeMember(Project $project, User $user)
    {
        $authUser = auth()->user();

        $isAdmin = $authUser->hasRole('Super Admin') || $authUser->hasRole('Admin');
        $isManager = $project->manager?->user?->id === $authUser->id;

        if (! $isAdmin && ! $isManager) {
            abort(403);
        }

        $project->members()->detach($user->id);

        return back()
            ->with('success', 'Member removed successfully.')
            ->with('activeTab', 'team');
    }

    public function uploadFile(Request $request, Project $project)
    {
        $this->authorizeProjectAccess($project);

        $request->validate([
            'file' => 'required|file|max:20480',
        ]);

        $file = $request->file('file');

        $path = $file->store('project-files', 'public');

        ProjectFile::create([
            'project_id' => $project->id,
            'user_id'    => auth()->id(),
            'name'       => $file->getClientOriginalName(),
            'path'       => $path,
            'type'       => $file->getClientMimeType(),
            'size'       => $file->getSize(),
        ]);

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'File uploaded successfully.')
            ->with('activeTab', 'files');
    }

    public function downloadFile(ProjectFile $projectFile)
    {
        $this->authorizeProjectAccess($projectFile->project);

        if (! Storage::disk('public')->exists($projectFile->path)) {
            abort(404);
        }

        return Storage::disk('public')->download(
            $projectFile->path,
            $projectFile->name
        );
    }

    private function authorizeProjectAccess(Project $project): void
    {
        $user = auth()->user();

        $isAdmin = $user->hasRole('Super Admin') || $user->hasRole('Admin');

        $isManager = $project->manager?->user?->id === $user->id;

        $isMember = $project->members()
            ->where('users.id', $user->id)
            ->exists();

        if (! $isAdmin && ! $isManager && ! $isMember) {
            abort(403);
        }
    }
}