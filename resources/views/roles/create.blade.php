@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Create Role</h1>

        <a href="{{ route('roles.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
            Back
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border rounded px-3 py-2">
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Display Name</label>
                <input type="text" name="display_name" value="{{ old('display_name') }}"
                       class="w-full border rounded px-3 py-2">
                @error('display_name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Description</label>
                <textarea name="description" rows="4"
                          class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="mt-8 mb-6">
                <h2 class="text-xl font-bold mb-4">Permissions</h2>

                @php
                    $permissions = [
                        'Dashboard' => [
                            'dashboard.view' => 'View Dashboard',
                        ],

                        'Projects' => [
                            'projects.view' => 'View Projects',
                            'projects.create' => 'Create Projects',
                            'projects.edit' => 'Edit Projects',
                            'projects.delete' => 'Delete Projects',
                            'projects.workspace' => 'Project Workspace',
                            'projects.board' => 'Project Board',
                            'projects.chat' => 'Project Chat',
                            'projects.files' => 'Project Files',
                            'projects.calendar' => 'Project Calendar',
                            'projects.reports' => 'Project Reports',
                            'projects.settings' => 'Project Settings',
                        ],

                        'Tasks' => [
                            'tasks.view' => 'View Tasks',
                            'tasks.create' => 'Create Tasks',
                            'tasks.edit' => 'Edit Tasks',
                            'tasks.delete' => 'Delete Tasks',
                            'tasks.assign' => 'Assign Tasks',
                            'tasks.status' => 'Change Task Status',
                        ],

                        'Teams' => [
                            'teams.view' => 'View Teams',
                            'teams.create' => 'Create Teams',
                            'teams.edit' => 'Edit Teams',
                            'teams.delete' => 'Delete Teams',
                        ],

                        'Employees' => [
                            'employees.view' => 'View Employees',
                            'employees.create' => 'Create Employees',
                            'employees.edit' => 'Edit Employees',
                            'employees.delete' => 'Delete Employees',
                        ],

                        'Departments' => [
                            'departments.view' => 'View Departments',
                            'departments.create' => 'Create Departments',
                            'departments.edit' => 'Edit Departments',
                            'departments.delete' => 'Delete Departments',
                        ],

                        'Roles & Permissions' => [
                            'roles.view' => 'View Roles',
                            'roles.create' => 'Create Roles',
                            'roles.edit' => 'Edit Roles',
                            'roles.delete' => 'Delete Roles',
                        ],

                        'Documents' => [
                            'documents.view' => 'View Documents',
                            'documents.create' => 'Upload Documents',
                            'documents.edit' => 'Edit Documents',
                            'documents.delete' => 'Delete Documents',
                        ],

                        'Finance' => [
                            'finance.view' => 'View Finance',
                            'income.view' => 'View Income',
                            'income.create' => 'Create Income',
                            'income.edit' => 'Edit Income',
                            'income.delete' => 'Delete Income',
                            'expenses.view' => 'View Expenses',
                            'expenses.create' => 'Create Expenses',
                            'expenses.edit' => 'Edit Expenses',
                            'expenses.delete' => 'Delete Expenses',
                        ],

                        'Notifications' => [
                            'notifications.view' => 'View Notifications',
                            'notifications.create' => 'Create Notifications',
                        ],
                    ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($permissions as $group => $items)
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <h3 class="font-bold mb-3 text-gray-800">{{ $group }}</h3>

                            <div class="space-y-2">
                                @foreach($items as $key => $label)
                                    <label class="flex items-center gap-2 text-sm">
                                        <input type="checkbox"
                                               name="permissions[]"
                                               value="{{ $key }}"
                                               {{ in_array($key, old('permissions', [])) ? 'checked' : '' }}>
                                        <span>{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Save Role
            </button>

        </form>

    </div>

</div>
@endsection