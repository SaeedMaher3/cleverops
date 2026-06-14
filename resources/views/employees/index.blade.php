@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Employees</h1>
            <p class="text-sm text-slate-500 mt-1">Manage company employees</p>
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

    <div class="page-card overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100">
                <tr>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Department</th>
                    <th class="px-4 py-3 text-left">Role</th>
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
                        <td class="px-4 py-3">{{ $employee->role->display_name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="font-semibold text-green-600">
                                {{ ucfirst(str_replace('_', ' ', $employee->status)) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
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