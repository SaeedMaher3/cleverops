@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Income</h1>
            <p class="text-sm text-slate-500 mt-1">Manage company income records</p>
        </div>

        <a href="{{ route('incomes.create') }}"
           class="btn-primary">
            Add Income
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
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">ID</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Title</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Amount</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Source</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Date</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-slate-700">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($incomes as $income)
                    <tr class="border-t hover:bg-slate-50">
                        <td class="px-4 py-3">{{ $income->id }}</td>
                        <td class="px-4 py-3 font-medium">{{ $income->title }}</td>
                        <td class="px-4 py-3 font-semibold text-green-600">
                            {{ number_format($income->amount, 2) }} JD
                        </td>
                        <td class="px-4 py-3">{{ $income->source ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $income->income_date }}</td>

                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('incomes.show', $income) }}"
                               class="text-purple-600 font-medium mr-3">
                                View
                            </a>

                            <a href="{{ route('incomes.edit', $income) }}"
                               class="text-blue-600 font-medium mr-3">
                                Edit
                            </a>

                            <form action="{{ route('incomes.destroy', $income) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Are you sure?')"
                                        class="text-red-600 font-medium">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-slate-500">
                            No income records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $incomes->links() }}
    </div>

</div>
@endsection