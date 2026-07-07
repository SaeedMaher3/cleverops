@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Edit Document</h1>
        <p class="text-slate-500 text-sm">Update document information</p>
    </div>

    <div class="page-card p-6 max-w-2xl">

        <form method="POST"
              action="{{ route('documents.update', $document) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2 font-medium">Title</label>
                <input type="text" name="title" value="{{ $document->title }}"
                       class="w-full border rounded-lg p-3" required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Category</label>
                <select name="category" class="w-full border rounded-lg p-3">
                    <option value="">Select Category</option>
                    <option value="HR" {{ $document->category == 'HR' ? 'selected' : '' }}>HR</option>
                    <option value="Finance" {{ $document->category == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="Projects" {{ $document->category == 'Projects' ? 'selected' : '' }}>Projects</option>
                    <option value="Reports" {{ $document->category == 'Reports' ? 'selected' : '' }}>Reports</option>
                    <option value="Contracts" {{ $document->category == 'Contracts' ? 'selected' : '' }}>Contracts</option>
                    <option value="Policies" {{ $document->category == 'Policies' ? 'selected' : '' }}>Policies</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Replace File</label>
                <input type="file" name="file" class="w-full border rounded-lg p-3">

                <p class="text-sm text-slate-500 mt-2">
                    Current file:
                    <a href="{{ asset('storage/' . $document->file) }}" target="_blank" class="text-blue-600">
                        Open
                    </a>
                </p>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">Description</label>
                <textarea name="description" rows="4"
                          class="w-full border rounded-lg p-3">{{ $document->description }}</textarea>
            </div>

            <button class="btn-primary">
                Update Document
            </button>

            <a href="{{ route('documents.index') }}" class="ml-3 text-slate-600 font-medium">
                Back
            </a>

        </form>

    </div>

</div>
@endsection