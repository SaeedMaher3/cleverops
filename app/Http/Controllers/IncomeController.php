<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::latest()->paginate(10);

        return view('incomes.index', compact('incomes'));
    }

    public function create()
    {
        return view('incomes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'amount'      => 'required|numeric',
            'source'      => 'nullable|string|max:255',
            'income_date' => 'required|date',
            'description' => 'nullable',
        ]);

        Income::create($request->all());

        return redirect()
            ->route('incomes.index')
            ->with('success', 'Income added successfully.');
    }

    public function show(Income $income)
    {
        return view('incomes.show', compact('income'));
    }

    public function edit(Income $income)
    {
        return view('incomes.edit', compact('income'));
    }

    public function update(Request $request, Income $income)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'amount'      => 'required|numeric',
            'source'      => 'nullable|string|max:255',
            'income_date' => 'required|date',
            'description' => 'nullable',
        ]);

        $income->update($request->all());

        return redirect()
            ->route('incomes.index')
            ->with('success', 'Income updated successfully.');
    }

    public function destroy(Income $income)
    {
        $income->delete();

        return redirect()
            ->route('incomes.index')
            ->with('success', 'Income deleted successfully.');
    }
}
