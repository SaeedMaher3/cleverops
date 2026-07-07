<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;

class FinanceController extends Controller
{
    public function index()
    {
        $totalIncome = Income::sum('amount');
        $totalExpenses = Expense::sum('amount');
        $netProfit = $totalIncome - $totalExpenses;

        $transactionsCount = Income::count() + Expense::count();

        $latestIncomes = Income::latest()->take(5)->get();
        $latestExpenses = Expense::latest()->take(5)->get();

        return view('finance.index', compact(
            'totalIncome',
            'totalExpenses',
            'netProfit',
            'transactionsCount',
            'latestIncomes',
            'latestExpenses'
        ));
    }
}