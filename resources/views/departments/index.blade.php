<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Departments
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Departments List</h3>

                    <a href="{{ route('departments.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded">
                        Add Department
                    </a>
                </div>

                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-3">ID</th>
                            <th class="border p-3">Name</th>
                            <th class="border p-3">Status</th>
                            <th class="border p-3">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($departments as $department)
                            <tr>
                                <td class="border p-3">{{ $department->id }}</td>

                                <td class="border p-3">{{ $department->name }}</td>

                                <td class="border p-3">
                                    {{ $department->status }}
                                </td>

                                <td class="border p-3">

                                    <a href="{{ route('departments.edit', $department) }}"
                                       style="background:#f59e0b;color:white;padding:5px 12px;border-radius:4px;text-decoration:none;">
                                        Edit
                                    </a>

                                    <form action="{{ route('departments.destroy', $department) }}"
                                          method="POST"
                                          style="display:inline-block;margin-left:5px;">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                style="background:#dc2626;color:white;padding:5px 12px;border:none;border-radius:4px;cursor:pointer;"
                                                onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>

                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border p-3 text-center">
                                    No departments found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>