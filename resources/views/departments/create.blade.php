@extends('layouts.app')

@section('content')

<div class="w-full px-6 py-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Create Department</h1>
            <p class="text-sm text-slate-500 mt-1">
                Add a new department
            </p>
        </div>

        <a href="{{ route('departments.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded">
            Back
        </a>
    </div>

    <div class="page-card p-6">

        <form action="{{ route('departments.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block mb-2 font-medium">Department Name</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full border rounded px-3 py-2"
                    required>
            </div>

            <div class="mb-5">
                <label class="block mb-2 font-medium">Description</label>
                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">Status</label>

                <select
                    name="status"
                    class="w-full border rounded px-3 py-2">

                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>

                </select>
            </div>

            <button
                class="btn-primary">
                Save Department
            </button>

        </form>

    </div>

</div>

@endsection