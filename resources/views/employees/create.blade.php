@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Create Employee</h1>

        <a href="{{ route('employees.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded">
            Back
        </a>
    </div>

    <div class="page-card p-6">

        <form action="{{ route('employees.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block mb-2 font-medium">Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}"
                           class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Job Title</label>
                    <input type="text" name="job_title" value="{{ old('job_title') }}"
                           class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Department</label>
                    <select name="department_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Hire Date</label>
                    <input type="date" name="hire_date" value="{{ old('hire_date') }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="on_leave" {{ old('status') == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                    </select>
                </div>

            </div>

            <div class="mt-6">
                <button type="submit" class="btn-primary">
                    Save Employee
                </button>
            </div>

        </form>

    </div>

</div>
@endsection