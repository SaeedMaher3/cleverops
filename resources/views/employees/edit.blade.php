@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Edit Employee</h1>

        <a href="{{ route('employees.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded">
            Back
        </a>
    </div>

    <div class="page-card p-6">

        <form action="{{ route('employees.update', $employee) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block mb-2 font-medium">Full Name</label>
                    <input type="text"
                           name="full_name"
                           value="{{ old('full_name', $employee->full_name) }}"
                           class="w-full border rounded px-3 py-2"
                           required>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email', $employee->email) }}"
                           class="w-full border rounded px-3 py-2"
                           required>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Phone</label>
                    <input type="text"
                           name="phone"
                           value="{{ old('phone', $employee->phone) }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Job Title</label>
                    <input type="text"
                           name="job_title"
                           value="{{ old('job_title', $employee->job_title) }}"
                           class="w-full border rounded px-3 py-2"
                           required>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Department</label>

                    <select name="department_id"
                            class="w-full border rounded px-3 py-2"
                            required>

                        @foreach($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Role</label>

                    <select name="role_id"
                            class="w-full border rounded px-3 py-2"
                            required>

                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ $employee->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->display_name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Hire Date</label>

                    <input type="date"
                           name="hire_date"
                           value="{{ old('hire_date', $employee->hire_date) }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Status</label>

                    <select name="status"
                            class="w-full border rounded px-3 py-2">

                        <option value="active"
                            {{ $employee->status == 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ $employee->status == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                        <option value="on_leave"
                            {{ $employee->status == 'on_leave' ? 'selected' : '' }}>
                            On Leave
                        </option>

                    </select>
                </div>

            </div>

            <div class="mt-6">
                <button type="submit"
                        class="btn-primary">
                    Update Employee
                </button>
            </div>

        </form>

    </div>

</div>
@endsection