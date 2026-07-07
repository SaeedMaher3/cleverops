@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Expenses</h1>
            <p class="text-sm text-slate-500 mt-1">Manage company expenses</p>
        </div>

        <a href="{{ route('expenses.create') }}"
           class="btn-primary">
            Add Expense
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
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Title</th>
                    <th class="px-4 py-3 text-left">Amount</th>
                    <th class="px-4 py-3 text-left">Category</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($expenses as $expense)
                    <tr class="border-t hover:bg-slate-50">
                        <td class="px-4 py-3">{{ $expense->id }}</td>
                        <td class="px-4 py-3">{{ $expense->title }}</td>

                        <td class="px-4 py-3 font-semibold text-red-600">
                            {{ number_format($expense->amount,2) }} JD
                        </td>

                        <td class="px-4 py-3">
                            {{ $expense->category ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $expense->expense_date }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('expenses.show',$expense) }}"
                               class="text-purple-600 mr-3">
                                View
                            </a>

                            <a href="{{ route('expenses.edit',$expense) }}"
                               class="text-blue-600 mr-3">
                                Edit
                            </a>

                            <form action="{{ route('expenses.destroy',$expense) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Delete expense?')"
                                    class="text-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6">
                            No expenses found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection