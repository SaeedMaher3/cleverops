<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
        ]);

        Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
            'status' => $request->status,
            'permissions' => $request->permissions ?? [],
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
        ]);

        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
            'status' => $request->status,
            'permissions' => $request->permissions ?? [],
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function seedDefaults()
    {
        $allPermissions = [
            'dashboard.view',

            'employees.view', 'employees.create', 'employees.edit', 'employees.delete',
            'departments.view', 'departments.create', 'departments.edit', 'departments.delete',
            'users.view', 'users.create', 'users.edit', 'users.delete',
            'roles.view', 'roles.create', 'roles.edit', 'roles.delete',

            'projects.view', 'projects.create', 'projects.edit', 'projects.delete',
            'projects.workspace', 'projects.board', 'projects.chat', 'projects.files',
            'projects.calendar', 'projects.reports', 'projects.settings',

            'tasks.view', 'tasks.create', 'tasks.edit', 'tasks.delete', 'tasks.assign', 'tasks.status',

            'teams.view', 'teams.create', 'teams.edit', 'teams.delete',
            'team_tasks.view', 'team_tasks.create', 'team_tasks.edit', 'team_tasks.delete',

            'documents.view', 'documents.create', 'documents.edit', 'documents.delete',

            'finance.view',
            'income.view', 'income.create', 'income.edit', 'income.delete',
            'expenses.view', 'expenses.create', 'expenses.edit', 'expenses.delete',

            'notifications.view', 'notifications.create',

            'reports.view',
            'settings.view', 'settings.edit',
        ];

        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Admin',
                'description' => 'Full system access.',
                'permissions' => $allPermissions,
            ],
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'Main administrator access.',
                'permissions' => $allPermissions,
            ],
            [
                'name' => 'project_manager',
                'display_name' => 'Project Manager',
                'description' => 'Manages projects, teams, tasks, and reports.',
                'permissions' => [
                    'dashboard.view',
                    'projects.view', 'projects.create', 'projects.edit',
                    'projects.workspace', 'projects.board', 'projects.chat',
                    'projects.files', 'projects.calendar', 'projects.reports',
                    'tasks.view', 'tasks.create', 'tasks.edit', 'tasks.assign', 'tasks.status',
                    'teams.view', 'teams.create', 'teams.edit',
                    'team_tasks.view', 'team_tasks.create', 'team_tasks.edit',
                    'documents.view', 'documents.create',
                    'notifications.view',
                    'reports.view',
                ],
            ],
            [
                'name' => 'team_leader',
                'display_name' => 'Team Leader',
                'description' => 'Leads team tasks and project collaboration.',
                'permissions' => [
                    'dashboard.view',
                    'projects.view', 'projects.workspace', 'projects.board',
                    'projects.chat', 'projects.files', 'projects.calendar',
                    'tasks.view', 'tasks.create', 'tasks.edit', 'tasks.assign', 'tasks.status',
                    'teams.view',
                    'team_tasks.view', 'team_tasks.create', 'team_tasks.edit',
                    'documents.view', 'documents.create',
                    'notifications.view',
                ],
            ],
            [
                'name' => 'staff',
                'display_name' => 'Staff',
                'description' => 'Employee access for daily work.',
                'permissions' => [
                    'dashboard.view',
                    'projects.view', 'projects.workspace', 'projects.board',
                    'projects.chat', 'projects.files', 'projects.calendar',
                    'tasks.view', 'tasks.status',
                    'team_tasks.view',
                    'documents.view', 'documents.create',
                    'notifications.view',
                ],
            ],
            [
                'name' => 'hr_manager',
                'display_name' => 'HR Manager',
                'description' => 'Manages employees and departments.',
                'permissions' => [
                    'dashboard.view',
                    'employees.view', 'employees.create', 'employees.edit',
                    'departments.view', 'departments.create', 'departments.edit',
                    'users.view', 'users.create', 'users.edit',
                    'notifications.view',
                ],
            ],
            [
                'name' => 'finance_manager',
                'display_name' => 'Finance Manager',
                'description' => 'Manages finance, income, and expenses.',
                'permissions' => [
                    'dashboard.view',
                    'finance.view',
                    'income.view', 'income.create', 'income.edit', 'income.delete',
                    'expenses.view', 'expenses.create', 'expenses.edit', 'expenses.delete',
                    'reports.view',
                    'notifications.view',
                ],
            ],
            [
                'name' => 'guest',
                'display_name' => 'Guest',
                'description' => 'Read-only limited access.',
                'permissions' => [
                    'dashboard.view',
                    'projects.view',
                    'tasks.view',
                    'documents.view',
                ],
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                [
                    'display_name' => $role['display_name'],
                    'description' => $role['description'],
                    'status' => 'active',
                    'permissions' => $role['permissions'],
                ]
            );
        }

        return redirect()
            ->route('roles.index')
            ->with('success', 'Default roles and permissions created successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}