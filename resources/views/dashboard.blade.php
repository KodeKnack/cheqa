@extends('layouts.app')

@section('title', 'Dashboard - Cheqa')

@section('content')
<div class="mb-4">
    <h2 class="text-primary">Hi {{ Auth::user()->name }}, welcome to your spending dashboard!</h2>
    <p class="text-muted">Here's an overview of your personal expenses</p>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Your Total Expenses</h6>
                        <h2 class="mb-0">R{{ number_format($totalExpenses, 2) }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-wallet2 display-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Your Monthly Expenses</h6>
                        <h2 class="mb-0">R{{ number_format($monthlyExpenses, 2) }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-calendar-month display-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-tags"></i> Your Expenses by Category</h5>
            </div>
            <div class="card-body">
                @if($expensesByCategory->count() > 0)
                    @foreach($expensesByCategory as $category)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>{{ $category->name }}</span>
                            <span class="fw-bold">R{{ number_format($category->total, 2) }}</span>
                        </div>
                        <div class="progress mb-3" style="height: 8px;">
                            <div class="progress-bar" style="width: {{ ($category->total / $totalExpenses) * 100 }}%"></div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No expenses recorded yet.</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-credit-card"></i> Your Expenses by Payment Method</h5>
            </div>
            <div class="card-body">
                @if($expensesByPaymentMethod->count() > 0)
                    @foreach($expensesByPaymentMethod as $method)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>{{ $method->name }}</span>
                            <span class="fw-bold">R{{ number_format($method->total, 2) }}</span>
                        </div>
                        <div class="progress mb-3" style="height: 8px;">
                            <div class="progress-bar bg-info" style="width: {{ ($method->total / $totalExpenses) * 100 }}%"></div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No expenses recorded yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@if($recentExpenses->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Your Recent Expenses</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Category</th>
                                <th>Payment Method</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentExpenses as $expense)
                            <tr>
                                <td>{{ $expense->description }}</td>
                                <td class="fw-bold text-danger">R{{ number_format($expense->amount, 2) }}</td>
                                <td><span class="badge bg-secondary">{{ $expense->category->name }}</span></td>
                                <td><span class="badge bg-info">{{ $expense->paymentMethod->name }}</span></td>
                                <td>{{ $expense->expense_date->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection