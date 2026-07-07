@extends('layouts.app')

@section('content')

<div class="mb-8">
    <h1 class="text-4xl font-extrabold text-[#21005D]">
        Edit Task
    </h1>

    <p class="text-slate-500 mt-2">
        Update task information
    </p>
</div>

<div class="bg-white rounded-[30px] shadow-lg p-8 max-w-4xl">

    <form method="POST" action="{{ route('tasks.update',$task) }}">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block font-bold text-[#21005D] mb-2">
                Task Title
            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title',$task->title) }}"
                class="w-full rounded-2xl border-slate-200 px-5 py-4 focus:border-purple-500 focus:ring-purple-500">
        </div>

        <div class="mb-5">
            <label class="block font-bold text-[#21005D] mb-2">
                Description
            </label>

            <textarea
                name="description"
                rows="4"
                class="w-full rounded-2xl border-slate-200 px-5 py-4 focus:border-purple-500 focus:ring-purple-500">{{ old('description',$task->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

            <div>
                <label class="block font-bold text-[#21005D] mb-2">
                    Employee
                </label>

                <select
                    name="employee_id"
                    class="w-full rounded-2xl border-slate-200 px-5 py-4">

                    <option value="">No Employee</option>

                    @foreach($employees as $employee)

                        <option
                            value="{{ $employee->id }}"
                            {{ $task->employee_id == $employee->id ? 'selected' : '' }}>

                            {{ $employee->full_name }}

                        </option>

                    @endforeach

                </select>
            </div>

            <div>
                <label class="block font-bold text-[#21005D] mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-2xl border-slate-200 px-5 py-4">

                    <option value="pending"
                        {{ $task->status == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="in_progress"
                        {{ $task->status == 'in_progress' ? 'selected' : '' }}>
                        In Progress
                    </option>

                    <option value="completed"
                        {{ $task->status == 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>

                </select>
            </div>

            <div>
                <label class="block font-bold text-[#21005D] mb-2">
                    Due Date
                </label>

                <input
                    type="date"
                    name="due_date"
                    value="{{ $task->due_date }}"
                    class="w-full rounded-2xl border-slate-200 px-5 py-4">
            </div>

        </div>

        <div class="flex justify-end gap-4">

            <a
                href="{{ route('tasks.index') }}"
                class="px-6 py-3 rounded-2xl bg-slate-100 font-bold">
                Back
            </a>

            <button
                type="submit"
                class="px-8 py-3 rounded-2xl bg-gradient-to-r from-purple-600 to-fuchsia-500 text-white font-bold">
                Update Task
            </button>

        </div>

    </form>

</div>

@endsection