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
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Add Department
                    </a>
                </div>

                <table class="w-full border border-gray-300 text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-3">ID</th>
                            <th class="border p-3">Name</th>
                            <th class="border p-3">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($departments as $department)
                            <tr>
                                <td class="border p-3">{{ $department->id }}</td>
                                <td class="border p-3">{{ $department->name }}</td>
                                <td class="border p-3">
                                    <span class="px-2 py-1 rounded text-sm bg-green-100 text-green-700">
                                        {{ $department->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="border p-3 text-center text-gray-500">
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