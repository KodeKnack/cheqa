<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Exports\ExpensesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::with(['category', 'paymentMethod'])->where('user_id', auth()->id());
        
        if ($request->has('filter') && $request->filter) {
            $query->filterByDateRange($request->filter);
        }
        
        if ($request->has('search') && $request->search) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }
        
        $expenses = $query->orderBy('expense_date', 'desc')->paginate(10);
        
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $categories = Category::all();
        $paymentMethods = PaymentMethod::all();
        
        return view('expenses.create', compact('categories', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'expense_date' => 'required|date'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        
        Expense::create($data);

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403);
        }
        
        $categories = Category::all();
        $paymentMethods = PaymentMethod::all();
        
        return view('expenses.edit', compact('expense', 'categories', 'paymentMethods'));
    }

    public function update(Request $request, Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403);
        }
        
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'expense_date' => 'required|date'
        ]);

        $expense->update($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403);
        }
        
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new ExpensesExport(auth()->id()), 'my-expenses-' . date('Y-m-d') . '.xlsx');
    }
}