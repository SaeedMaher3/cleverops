@extends('layouts.app')

@section('content')

<div class="w-full px-6 py-6">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">
            Financial Dashboard
        </h1>

        <p class="text-slate-500 mt-2">
            Overview of company finances
        </p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <div class="page-card p-6">
            <div class="text-sm text-slate-500">Total Income</div>

            <div class="text-3xl font-bold text-green-600 mt-2">
                {{ number_format($totalIncome, 2) }} JD
            </div>
        </div>

        <div class="page-card p-6">
            <div class="text-sm text-slate-500">Total Expenses</div>

            <div class="text-3xl font-bold text-red-600 mt-2">
                {{ number_format($totalExpenses, 2) }} JD
            </div>
        </div>

        <div class="page-card p-6">
            <div class="text-sm text-slate-500">Net Profit</div>

            <div class="text-3xl font-bold text-blue-600 mt-2">
                {{ number_format($netProfit, 2) }} JD
            </div>
        </div>

        <div class="page-card p-6">
            <div class="text-sm text-slate-500">Transactions</div>

            <div class="text-3xl font-bold text-purple-600 mt-2">
                {{ $transactionsCount }}
            </div>
        </div>

    </div>

    <!-- Latest Income -->
    <div class="page-card p-6 mb-8">

        <h2 class="text-xl font-bold mb-4">
            Latest Income
        </h2>

        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-3">Title</th>
                    <th class="text-left py-3">Amount</th>
                    <th class="text-left py-3">Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($latestIncomes as $income)
                    <tr class="border-b">
                        <td class="py-3">{{ $income->title }}</td>
                        <td class="py-3 text-green-600">
                            {{ number_format($income->amount,2) }} JD
                        </td>
                        <td class="py-3">{{ $income->income_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-slate-500">
                            No income records found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <!-- Latest Expenses -->
    <div class="page-card p-6">

        <h2 class="text-xl font-bold mb-4">
            Latest Expenses
        </h2>

        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-3">Title</th>
                    <th class="text-left py-3">Amount</th>
                    <th class="text-left py-3">Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($latestExpenses as $expense)
                    <tr class="border-b">
                        <td class="py-3">{{ $expense->title }}</td>
                        <td class="py-3 text-red-600">
                            {{ number_format($expense->amount,2) }} JD
                        </td>
                        <td class="py-3">{{ $expense->expense_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-slate-500">
                            No expense records found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection