@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Roles</h1>

        <a href="{{ route('roles.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Add Role
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Display Name</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($roles as $role)
                    <tr class="border-t">
                        <td class="px-4 py-3">{{ $role->id }}</td>
                        <td class="px-4 py-3">{{ $role->name }}</td>
                        <td class="px-4 py-3">{{ $role->display_name }}</td>
                        <td class="px-4 py-3">
                            @if($role->status == 'active')
                                <span class="text-green-600 font-semibold">
                                    Active
                                </span>
                            @else
                                <span class="text-red-600 font-semibold">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('roles.edit', $role) }}"
                               class="text-blue-600 mr-3">
                                Edit
                            </a>

                            <form action="{{ route('roles.destroy', $role) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Delete this role?')"
                                        class="text-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6">
                            No roles found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $roles->links() }}
    </div>

</div>
@endsection