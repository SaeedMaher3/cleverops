@extends('layouts.app')

@section('content')

<div class="w-full px-6 py-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Teams
            </h1>

            <p class="text-slate-500 text-sm">
                Manage company teams
            </p>
        </div>

        <a href="{{ route('teams.create') }}"
           class="btn-primary">
            Create Team
        </a>

    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="page-card overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">
                <tr>
                    <th class="px-4 py-3 text-left">Team</th>
                    <th class="px-4 py-3 text-left">Department</th>
                    <th class="px-4 py-3 text-left">Leader</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($teams as $team)

                    <tr class="border-t">

                        <td class="px-4 py-3 font-semibold">
                            {{ $team->name }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $team->department->name ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $team->leader->full_name ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            @if($team->status == 'active')
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

                            <a href="{{ route('teams.show',$team) }}"
                               class="text-purple-600 mr-3">
                                View
                            </a>

                            <a href="{{ route('teams.edit',$team) }}"
                               class="text-blue-600 mr-3">
                                Edit
                            </a>

                            <form action="{{ route('teams.destroy',$team) }}"
                                  method="POST"
                                  class="inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Delete team?')"
                                    class="text-red-600">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center py-6 text-slate-500">
                            No teams found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection