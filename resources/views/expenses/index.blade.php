@extends('layouts.app')

@section('title', 'Expenses - Cheqa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-receipt"></i> Expenses</h1>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Expense
    </a>
</div>

<div class="row mb-4">
    <div class="col-md-8">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Search expenses..." value="{{ request('search') }}">
            <select name="filter" class="form-select" style="width: auto;">
                <option value="">All Time</option>
                <option value="daily" {{ request('filter') == 'daily' ? 'selected' : '' }}>Today</option>
                <option value="weekly" {{ request('filter') == 'weekly' ? 'selected' : '' }}>This Week</option>
                <option value="monthly" {{ request('filter') == 'monthly' ? 'selected' : '' }}>This Month</option>
                <option value="yearly" {{ request('filter') == 'yearly' ? 'selected' : '' }}>This Year</option>
            </select>
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-search"></i>
            </button>
            <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-x-circle"></i>
            </a>
        </form>
    </div>
</div>

@if($expenses->count() > 0)
    <div class="card">
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
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $expense)
                        <tr>
                            <td>{{ $expense->description }}</td>
                            <td class="fw-bold text-danger">${{ number_format($expense->amount, 2) }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $expense->category->name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $expense->paymentMethod->name }}</span>
                            </td>
                            <td>{{ $expense->expense_date->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('expenses.destroy', $expense) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            <strong>Total: ${{ number_format($expenses->sum('amount'), 2) }}</strong>
        </div>
        {{ $expenses->links() }}
    </div>
@else
    <div class="text-center py-5">
        <i class="bi bi-receipt display-1 text-muted"></i>
        <h3 class="mt-3">No expenses found</h3>
        <p class="text-muted">Start tracking your expenses by adding your first one.</p>
        <a href="{{ route('expenses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Your First Expense
        </a>
    </div>
@endif
@endsection