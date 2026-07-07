@extends('layouts.app')

@section('content')

<div class="mb-8">
    <h1 class="text-4xl font-extrabold text-[#21005D]">Add Task</h1>
    <p class="text-slate-500 mt-2">Create a new task and assign it to an employee</p>
</div>

<div class="bg-white rounded-[30px] shadow-lg p-8 max-w-4xl">

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <div class="mb-5">
            <label class="block font-bold text-[#21005D] mb-2">Task Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full rounded-2xl border-slate-200 px-5 py-4 focus:border-purple-500 focus:ring-purple-500"
                   placeholder="Enter task title">
            @error('title')
                <p class="text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label class="block font-bold text-[#21005D] mb-2">Description</label>
            <textarea name="description" rows="4"
                      class="w-full rounded-2xl border-slate-200 px-5 py-4 focus:border-purple-500 focus:ring-purple-500"
                      placeholder="Enter task description">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

            <div>
                <label class="block font-bold text-[#21005D] mb-2">Assign Employee</label>
                <select name="employee_id"
                        class="w-full rounded-2xl border-slate-200 px-5 py-4 focus:border-purple-500 focus:ring-purple-500">
                    <option value="">No Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">
                            {{ $employee->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-bold text-[#21005D] mb-2">Status</label>
                <select name="status"
                        class="w-full rounded-2xl border-slate-200 px-5 py-4 focus:border-purple-500 focus:ring-purple-500">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <div>
                <label class="block font-bold text-[#21005D] mb-2">Due Date</label>
                <input type="date" name="due_date" value="{{ old('due_date') }}"
                       class="w-full rounded-2xl border-slate-200 px-5 py-4 focus:border-purple-500 focus:ring-purple-500">
            </div>

        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('tasks.index') }}"
               class="px-6 py-3 rounded-2xl bg-slate-100 text-slate-700 font-bold">
                Back
            </a>

            <button type="submit"
                    class="px-8 py-3 rounded-2xl bg-gradient-to-r from-purple-600 to-fuchsia-500 text-white font-bold shadow-lg">
                Save Task
            </button>
        </div>

    </form>

</div>

@endsection