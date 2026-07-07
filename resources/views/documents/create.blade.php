@extends('layouts.app')

@section('content')

<div class="w-full px-6 py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">
            Upload Document
        </h1>

        <p class="text-slate-500 text-sm">
            Add a new document to the archive
        </p>
    </div>

    <div class="page-card p-6 max-w-2xl">

        <form method="POST"
              action="{{ route('documents.store') }}"
              enctype="multipart/form-data">

            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-medium">
                    Title
                </label>

                <input
                    type="text"
                    name="title"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">
                    Category
                </label>

                <input
                    type="text"
                    name="category"
                    class="w-full border rounded-lg p-3"
                    placeholder="Policies, Contracts, Reports...">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">
                    File
                </label>

                <input
                    type="file"
                    name="file"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded-lg p-3"></textarea>
            </div>

            <button class="btn-primary">
                Upload Document
            </button>

        </form>

    </div>

</div>

@endsection