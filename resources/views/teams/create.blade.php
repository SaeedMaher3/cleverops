@extends('layouts.app')

@section('content')

<div class="w-full px-6 py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">
            Create Team
        </h1>

        <p class="text-slate-500 text-sm">
            Create a new work team
        </p>
    </div>

    <div class="page-card p-6 max-w-3xl">

        <form method="POST" action="{{ route('teams.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-medium">
                    Team Name
                </label>

                <input
                    type="text"
                    name="name"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">
                    Department
                </label>

                <select
                    name="department_id"
                    class="w-full border rounded-lg p-3"
                    required>

                    <option value="">
                        Select Department
                    </option>

                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">
                            {{ $department->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">
                    Team Leader
                </label>

                <select
                    name="leader_id"
                    class="w-full border rounded-lg p-3">

                    <option value="">
                        Select Leader
                    </option>

                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">
                            {{ $employee->full_name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border rounded-lg p-3">

                    <option value="active">
                        Active
                    </option>

                    <option value="inactive">
                        Inactive
                    </option>

                </select>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded-lg p-3"></textarea>
            </div>

            <button class="btn-primary">
                Create Team
            </button>

        </form>

    </div>

</div>

@endsection