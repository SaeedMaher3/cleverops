@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Employees</h1>
            <p class="text-sm text-slate-500 mt-1">Manage company employees and login accounts</p>
        </div>

        <a href="{{ route('employees.create') }}" class="btn-primary">
            Add Employee
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="page-card overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100">
                <tr>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Department</th>
                    <th class="px-4 py-3 text-left">Account Role</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($employees as $employee)
                    <tr class="border-t hover:bg-slate-50">
                        <td class="px-4 py-3 font-medium">{{ $employee->full_name }}</td>
                        <td class="px-4 py-3">{{ $employee->email }}</td>
                        <td class="px-4 py-3">{{ $employee->department->name ?? '-' }}</td>

                        <td class="px-4 py-3">
                            @if($employee->user)
                                <span class="text-green-600 font-semibold">
                                    {{ $employee->user->role?->display_name ?? 'No Role' }}
                                </span>
                            @else
                                <span class="text-red-500 font-semibold">No Account</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <span class="font-semibold text-green-600">
                                {{ ucfirst(str_replace('_', ' ', $employee->status)) }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-center">
                            @if(!$employee->user)
                                <button type="button"
                                        onclick="document.getElementById('createAccountModal{{ $employee->id }}').classList.remove('hidden')"
                                        class="text-green-600 font-medium mr-3">
                                    Create Account
                                </button>
                            @else
                                <span class="text-slate-500 font-medium mr-3">Account Created</span>
                            @endif

                            <a href="{{ route('employees.edit', $employee) }}"
                               class="text-blue-600 font-medium mr-3">
                                Edit
                            </a>

                            <form action="{{ route('employees.destroy', $employee) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Delete this employee?')"
                                        class="text-red-600 font-medium">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    @if(!$employee->user)
                        <div id="createAccountModal{{ $employee->id }}"
                             class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">

                            <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-xl">
                                <h2 class="text-xl font-bold mb-4">Create Login Account</h2>

                                <form action="{{ route('employees.account.store', $employee) }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="block text-sm font-medium mb-1">Employee</label>
                                        <input type="text"
                                               value="{{ $employee->full_name }}"
                                               class="w-full border rounded px-3 py-2 bg-gray-100"
                                               disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label class="block text-sm font-medium mb-1">Login Email</label>
                                        <input type="email"
                                               name="email"
                                               value="{{ $employee->email }}"
                                               class="w-full border rounded px-3 py-2"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="block text-sm font-medium mb-1">Password</label>
                                        <input type="password"
                                               name="password"
                                               class="w-full border rounded px-3 py-2"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="block text-sm font-medium mb-1">Confirm Password</label>
                                        <input type="password"
                                               name="password_confirmation"
                                               class="w-full border rounded px-3 py-2"
                                               required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium mb-1">Role</label>
                                        <select name="role_id"
                                                class="w-full border rounded px-3 py-2"
                                                required>
                                            <option value="">Select Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">
                                                    {{ $role->display_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="flex justify-end gap-2">
                                        <button type="button"
                                                onclick="document.getElementById('createAccountModal{{ $employee->id }}').classList.add('hidden')"
                                                class="bg-gray-500 text-white px-4 py-2 rounded">
                                            Cancel
                                        </button>

                                        <button type="submit"
                                                class="bg-blue-600 text-white px-4 py-2 rounded">
                                            Create Account
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-slate-500">
                            No employees found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $employees->links() }}
    </div>

</div>
@endsection