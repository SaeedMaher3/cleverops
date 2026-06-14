@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Edit Role</h1>

        <a href="{{ route('roles.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
            Back
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">

        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2 font-medium">Name</label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $role->name) }}"
                       class="w-full border rounded px-3 py-2">

                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Display Name</label>
                <input type="text"
                       name="display_name"
                       value="{{ old('display_name', $role->display_name) }}"
                       class="w-full border rounded px-3 py-2">

                @error('display_name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Description</label>

                <textarea name="description"
                          rows="4"
                          class="w-full border rounded px-3 py-2">{{ old('description', $role->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Status</label>

                <select name="status"
                        class="w-full border rounded px-3 py-2">

                    <option value="active"
                        {{ $role->status == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive"
                        {{ $role->status == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Update Role
            </button>

        </form>

    </div>

</div>
@endsection