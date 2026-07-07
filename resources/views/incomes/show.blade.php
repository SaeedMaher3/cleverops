@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">
            Income Details
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            View income information
        </p>
    </div>

    <div class="page-card p-6 max-w-3xl">

        <div class="grid grid-cols-2 gap-6">

            <div>
                <label class="text-slate-500 text-sm">Title</label>
                <div class="font-semibold text-lg">
                    {{ $income->title }}
                </div>
            </div>

            <div>
                <label class="text-slate-500 text-sm">Amount</label>
                <div class="font-semibold text-green-600 text-lg">
                    {{ number_format($income->amount, 2) }} JD
                </div>
            </div>

            <div>
                <label class="text-slate-500 text-sm">Source</label>
                <div class="font-medium">
                    {{ $income->source ?? '-' }}
                </div>
            </div>

            <div>
                <label class="text-slate-500 text-sm">Income Date</label>
                <div class="font-medium">
                    {{ $income->income_date }}
                </div>
            </div>

        </div>

        <div class="mt-6">
            <label class="text-slate-500 text-sm">Description</label>

            <div class="mt-2 p-4 bg-slate-50 rounded-lg">
                {{ $income->description ?? 'No description available.' }}
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('incomes.index') }}"
               class="btn-primary">
                Back To Income List
            </a>
        </div>

    </div>

</div>
@endsection