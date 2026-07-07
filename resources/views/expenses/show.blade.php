@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">
            Expense Details
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            View expense information
        </p>
    </div>

    <div class="page-card p-6 max-w-3xl">

        <div class="grid grid-cols-2 gap-6">

            <div>
                <label class="text-slate-500 text-sm">Title</label>
                <div class="font-semibold text-lg">
                    {{ $expense->title }}
                </div>
            </div>

            <div>
                <label class="text-slate-500 text-sm">Amount</label>
                <div class="font-semibold text-red-600 text-lg">
                    {{ number_format($expense->amount, 2) }} JD
                </div>
            </div>

            <div>
                <label class="text-slate-500 text-sm">Category</label>
                <div class="font-medium">
                    {{ $expense->category ?? '-' }}
                </div>
            </div>

            <div>
                <label class="text-slate-500 text-sm">Expense Date</label>
                <div class="font-medium">
                    {{ $expense->expense_date }}
                </div>
            </div>

        </div>

        <div class="mt-6">
            <label class="text-slate-500 text-sm">Description</label>

            <div class="mt-2 p-4 bg-slate-50 rounded-lg">
                {{ $expense->description ?? 'No description available.' }}
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('expenses.index') }}"
               class="btn-primary">
                Back To Expenses List
            </a>
        </div>

    </div>

</div>
@endsection