<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Add Department
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl">

        <form method="POST" action="{{ route('departments.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">Department Name</label>
                <input type="text" name="name" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Description</label>
                <textarea name="description" class="w-full border rounded p-2"></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Save
            </button>

            <a href="{{ route('departments.index') }}" class="ml-3">
                Back
            </a>
        </form>

    </div>

</x-app-layout>