@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Team Tasks</h1>
            <p class="text-slate-500 text-sm">Manage tasks assigned to teams</p>
        </div>

        <a href="{{ route('team-tasks.create') }}" class="btn-primary">
            Create Team Task
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
                    <th class="px-4 py-3 text-left">Task</th>
                    <th class="px-4 py-3 text-left">Team</th>
                    <th class="px-4 py-3 text-left">Assigned To</th>
                    <th class="px-4 py-3 text-left">Priority</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Due Date</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($tasks as $task)
                    <tr class="border-t hover:bg-slate-50">
                        <td class="px-4 py-3 font-semibold">{{ $task->title }}</td>
                        <td class="px-4 py-3">{{ $task->team->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $task->employee->full_name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ ucfirst($task->priority) }}</td>
                        <td class="px-4 py-3">{{ str_replace('_', ' ', ucfirst($task->status)) }}</td>
                        <td class="px-4 py-3">{{ $task->due_date ?? '-' }}</td>

                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('team-tasks.edit', $task) }}"
                               class="text-blue-600 mr-3">
                                Edit
                            </a>

                            <form action="{{ route('team-tasks.destroy', $task) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Delete task?')"
                                        class="text-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-slate-500">
                            No team tasks found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection