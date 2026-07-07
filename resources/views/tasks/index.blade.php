@extends('layouts.app')

@section('content')

<div class="mb-8 flex justify-between items-center">

    <div>
        <h1 class="text-4xl font-extrabold text-[#21005D]">
            Tasks
        </h1>

        <p class="text-slate-500 mt-2">
            Manage all company tasks
        </p>
    </div>

    <a href="{{ route('tasks.create') }}"
       class="px-6 py-3 rounded-2xl bg-gradient-to-r from-purple-600 to-fuchsia-500 text-white font-bold shadow-lg">
        + Add Task
    </a>

</div>

<div class="bg-white rounded-[30px] shadow-lg overflow-hidden">

    <table class="w-full">

        <thead class="bg-slate-50">
            <tr>

                <th class="text-left p-5">Title</th>
                <th class="text-left p-5">Employee</th>
                <th class="text-left p-5">Status</th>
                <th class="text-left p-5">Due Date</th>
                <th class="text-left p-5">Actions</th>

            </tr>
        </thead>

        <tbody>

        @forelse($tasks as $task)

            <tr class="border-b">

                <td class="p-5 font-semibold">
                    {{ $task->title }}
                </td>

                <td>
                    {{ $task->employee->full_name ?? '-' }}
                </td>

                <td>

                    @if($task->status == 'pending')
                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                            Pending
                        </span>
                    @elseif($task->status == 'in_progress')
                        <span class="px-3 py-1 rounded-full bg-cyan-100 text-cyan-700">
                            In Progress
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                            Completed
                        </span>
                    @endif

                </td>

                <td>
                    {{ $task->due_date ?? '-' }}
                </td>

                <td class="flex gap-3 p-5">

                    <a href="{{ route('tasks.edit',$task) }}"
                       class="text-cyan-600 font-bold">
                        Edit
                    </a>

                    <form action="{{ route('tasks.destroy',$task) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button class="text-red-600 font-bold">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="5" class="text-center p-10 text-slate-500">
                    No Tasks Found
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection