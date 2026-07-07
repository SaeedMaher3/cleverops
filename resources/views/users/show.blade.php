@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">User Details</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <p class="mb-3"><strong>Name:</strong> {{ $user->name }}</p>
        <p class="mb-3"><strong>Email:</strong> {{ $user->email }}</p>
        <p class="mb-3"><strong>Role:</strong> {{ $user->role?->display_name ?? 'No Role' }}</p>

        <a href="{{ route('users.index') }}" class="inline-block mt-4 bg-gray-600 text-white px-4 py-2 rounded">
            Back
        </a>
    </div>
</div>
@endsection