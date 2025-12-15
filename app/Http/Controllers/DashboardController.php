<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalExpenses = Expense::sum('amount');
        $monthlyExpenses = Expense::whereMonth('expense_date', now()->month)
                                 ->whereYear('expense_date', now()->year)
                                 ->sum('amount');
        
        $expensesByCategory = Expense::select('categories.name', DB::raw('SUM(expenses.amount) as total'))
                                   ->join('categories', 'expenses.category_id', '=', 'categories.id')
                                   ->groupBy('categories.id', 'categories.name')
                                   ->orderBy('total', 'desc')
                                   ->get();
        
        $expensesByPaymentMethod = Expense::select('payment_methods.name', DB::raw('SUM(expenses.amount) as total'))
                                        ->join('payment_methods', 'expenses.payment_method_id', '=', 'payment_methods.id')
                                        ->groupBy('payment_methods.id', 'payment_methods.name')
                                        ->orderBy('total', 'desc')
                                        ->get();
        
        $recentExpenses = Expense::with(['category', 'paymentMethod'])
                                ->orderBy('expense_date', 'desc')
                                ->limit(5)
                                ->get();
        
        return view('dashboard', compact(
            'totalExpenses',
            'monthlyExpenses',
            'expensesByCategory',
            'expensesByPaymentMethod',
            'recentExpenses'
        ));
    }
}