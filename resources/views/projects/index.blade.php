@extends('layouts.app')

@section('content')

@php
    $roleName = strtolower(auth()->user()->role?->name ?? '');
    $canManageProjects = in_array($roleName, ['super admin', 'admin', 'team leader']);
@endphp

<div class="w-full px-6 py-6">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Projects Workspace</h1>
            <p class="text-slate-500 mt-1">Manage company projects as workspaces</p>
        </div>

        @if($canManageProjects)
            <a href="{{ route('projects.create') }}" class="btn-primary">
                Create Project
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        @forelse($projects as $project)

            <div class="page-card p-6 hover:-translate-y-1 transition duration-300">

                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">
                            {{ $project->name }}
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Manager: {{ $project->manager->full_name ?? 'Not assigned' }}
                        </p>
                    </div>

                    <span class="w-4 h-4 rounded-full"
                          style="background: {{ $project->color }}"></span>
                </div>

                <p class="text-slate-500 text-sm mb-5 line-clamp-2">
                    {{ $project->description ?? 'No description available.' }}
                </p>

                <div class="mb-4">
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-slate-500">Progress</span>
                        <span class="font-bold">{{ $project->progress }}%</span>
                    </div>

                    <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full"
                             style="width: {{ $project->progress }}%; background: {{ $project->color }}"></div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 text-sm mb-5">

                    <div class="bg-slate-50 rounded-xl p-3">
                        <div class="text-slate-400">Priority</div>
                        <div class="font-bold">{{ ucfirst($project->priority) }}</div>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-3">
                        <div class="text-slate-400">Status</div>
                        <div class="font-bold">{{ str_replace('_',' ', ucfirst($project->status)) }}</div>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-3">
                        <div class="text-slate-400">Deadline</div>
                        <div class="font-bold">{{ $project->deadline ?? '-' }}</div>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-3">
                        <div class="text-slate-400">Budget</div>
                        <div class="font-bold">
                            {{ $project->budget ? number_format($project->budget,2).' JD' : '-' }}
                        </div>
                    </div>

                </div>

                <div class="flex justify-between items-center">

                    <a href="{{ route('projects.show',$project) }}" class="btn-primary">
                        Open Workspace
                    </a>

                    @if($canManageProjects)

                        <div class="flex items-center">

                            <a href="{{ route('projects.edit',$project) }}"
                               class="text-blue-600 font-medium mr-3">
                                Edit
                            </a>

                            <form action="{{ route('projects.destroy',$project) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Delete project?')"
                                        class="text-red-600 font-medium">
                                    Delete
                                </button>
                            </form>

                        </div>

                    @endif

                </div>

            </div>

        @empty

            <div class="page-card p-10 text-center text-slate-500 col-span-full">
                No projects found.
            </div>

        @endforelse

    </div>

</div>

@endsection