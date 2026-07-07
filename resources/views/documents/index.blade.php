@extends('layouts.app')

@section('content')

<div class="w-full px-6 py-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Documents
            </h1>

            <p class="text-slate-500 text-sm">
                Company document archive
            </p>
        </div>

        <a href="{{ route('documents.create') }}"
           class="btn-primary">
            Upload Document
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
                    <th class="px-4 py-3 text-left">Title</th>
                    <th class="px-4 py-3 text-left">Category</th>
                    <th class="px-4 py-3 text-left">Created</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($documents as $document)

                    <tr class="border-t">

                        <td class="px-4 py-3">
                            {{ $document->title }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $document->category ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $document->created_at->format('Y-m-d') }}
                        </td>

                        <td class="px-4 py-3 text-center">

                            <a href="{{ route('documents.show',$document) }}"
                               class="text-purple-600 mr-3">
                                View
                            </a>

                            <a href="{{ route('documents.edit',$document) }}"
                               class="text-blue-600 mr-3">
                                Edit
                            </a>

                            <form action="{{ route('documents.destroy',$document) }}"
                                  method="POST"
                                  class="inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Delete document?')"
                                    class="text-red-600">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center py-6 text-slate-500">
                            No documents found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection