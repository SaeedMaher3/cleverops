@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Edit Income</h1>
        <p class="text-sm text-slate-500 mt-1">Update income record</p>
    </div>

    <div class="page-card p-6 max-w-2xl">

        <form method="POST" action="{{ route('incomes.update', $income) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1 font-medium">Title</label>
                <input type="text" name="title" value="{{ $income->title }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Amount (JD)</label>
                <input type="number" step="0.01" name="amount" value="{{ $income->amount }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Source</label>
                <input type="text" name="source" value="{{ $income->source }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Income Date</label>
                <input type="date" name="income_date" value="{{ $income->income_date }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Description</label>
                <textarea name="description" rows="4" class="w-full border rounded p-2">{{ $income->description }}</textarea>
            </div>

            <button class="btn-primary">
                Update Income
            </button>

            <a href="{{ route('incomes.index') }}" class="ml-3 text-slate-600 font-medium">
                Back
            </a>

        </form>

    </div>

</div>
@endsection