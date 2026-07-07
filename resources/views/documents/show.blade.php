@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Document Details</h1>
        <p class="text-slate-500 text-sm">View and download document</p>
    </div>

    <div class="page-card p-6 max-w-4xl">

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <div class="text-sm text-slate-500">Title</div>
                <div class="font-bold text-lg">{{ $document->title }}</div>
            </div>

            <div>
                <div class="text-sm text-slate-500">Category</div>
                <div class="font-semibold">{{ $document->category ?? '-' }}</div>
            </div>

            <div>
                <div class="text-sm text-slate-500">Uploaded At</div>
                <div class="font-semibold">{{ $document->created_at->format('Y-m-d') }}</div>
            </div>

            <div>
                <div class="text-sm text-slate-500">File</div>
                <a href="{{ asset('storage/' . $document->file) }}"
                   target="_blank"
                   class="text-blue-600 font-semibold">
                    Open File
                </a>
            </div>
        </div>

        <div class="mb-6">
            <div class="text-sm text-slate-500 mb-2">Description</div>
            <div class="bg-slate-50 p-4 rounded-lg">
                {{ $document->description ?? 'No description available.' }}
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ asset('storage/' . $document->file) }}"
               download
               class="btn-primary">
                Download
            </a>

            <a href="{{ route('documents.edit', $document) }}"
               class="px-4 py-2 rounded bg-blue-600 text-white">
                Edit
            </a>

            <a href="{{ route('documents.index') }}"
               class="px-4 py-2 rounded bg-slate-200 text-slate-700">
                Back
            </a>
        </div>

    </div>

</div>
@endsection