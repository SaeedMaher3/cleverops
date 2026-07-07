@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Create User</h1>

        <a href="{{ route('users.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
            Back
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full border rounded px-3 py-2">
                        @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full border rounded px-3 py-2">
                        @error('email') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Password</label>
                        <input type="password" name="password"
                               class="w-full border rounded px-3 py-2">
                        @error('password') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Role</label>
                        <select name="role_id" id="roleSelect"
                                class="w-full border rounded px-3 py-2">
                            <option value="">Select Role</option>

                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                        data-permissions='@json($role->permissions ?? [])'
                                        {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->display_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Create User
                    </button>
                </div>

                <div>
                    <div class="border rounded-xl p-5 bg-gray-50">
                        <h2 class="text-lg font-bold mb-2">Role Permissions Preview</h2>
                        <p class="text-sm text-gray-500 mb-4">
                            Select a role to see what this user can access.
                        </p>

                        <div id="permissionsPreview" class="space-y-2 text-sm">
                            <div class="text-gray-400">No role selected.</div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('roleSelect');
    const preview = document.getElementById('permissionsPreview');

    function renderPermissions() {
        const selected = roleSelect.options[roleSelect.selectedIndex];
        const permissions = JSON.parse(selected.dataset.permissions || '[]');

        preview.innerHTML = '';

        if (!permissions.length) {
            preview.innerHTML = '<div class="text-gray-400">No permissions assigned.</div>';
            return;
        }

        permissions.forEach(permission => {
            const item = document.createElement('div');
            item.className = 'flex items-center gap-2 bg-white border rounded px-3 py-2';
            item.innerHTML = `<span class="text-green-600">✅</span><span>${permission}</span>`;
            preview.appendChild(item);
        });
    }

    roleSelect.addEventListener('change', renderPermissions);
    renderPermissions();
});
</script>
@endsection