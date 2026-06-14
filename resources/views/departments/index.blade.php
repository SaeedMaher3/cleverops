@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Departments</h1>
            <p class="text-sm text-slate-500 mt-1">Manage company departments</p>
        </div>

        <a href="{{ route('departments.create') }}"
           class="btn-primary">
            Add Department
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
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">ID</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Name</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Status</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-slate-700">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($departments as $department)
                    <tr class="border-t hover:bg-slate-50">
                        <td class="px-4 py-3">{{ $department->id }}</td>
                        <td class="px-4 py-3 font-medium">{{ $department->name }}</td>

                        <td class="px-4 py-3">
                            @if($department->status == 'active')
                                <span class="text-green-600 font-semibold">Active</span>
                            @else
                                <span class="text-red-600 font-semibold">Inactive</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('departments.edit', $department) }}"
                               class="text-blue-600 font-medium mr-3">
                                Edit
                            </a>

                            <form action="{{ route('departments.destroy', $department) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Are you sure?')"
                                        class="text-red-600 font-medium">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-slate-500">
                            No departments found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection