<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Department
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('departments.update', $department) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Name
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $department->name) }}"
                               class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Description
                        </label>

                        <textarea name="description"
                                  rows="4"
                                  class="w-full border rounded p-2">{{ old('description', $department->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Status
                        </label>

                        <select name="status"
                                class="w-full border rounded p-2">

                            <option value="active"
                                {{ $department->status == 'active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="inactive"
                                {{ $department->status == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>
                    </div>

                    <div class="flex gap-2">

                        <button type="submit"
                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Update Department
                        </button>

                        <a href="{{ route('departments.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>