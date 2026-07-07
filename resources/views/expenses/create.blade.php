@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Add Expense</h1>
    </div>

    <div class="page-card p-6 max-w-2xl">

        <form method="POST" action="{{ route('expenses.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">Title</label>
                <input type="text" name="title" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Amount</label>
                <input type="number" step="0.01" name="amount" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Category</label>
                <input type="text" name="category" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Expense Date</label>
                <input type="date" name="expense_date" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Description</label>
                <textarea name="description" rows="4" class="w-full border rounded p-2"></textarea>
            </div>

            <button class="btn-primary">
                Save Expense
            </button>

        </form>

    </div>

</div>
@endsection