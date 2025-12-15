@extends('layouts.app')

@section('title', 'Payment Methods - Cheqa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-credit-card"></i> Payment Methods</h1>
    <a href="{{ route('payment_methods.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Payment Method
    </a>
</div>

@if($paymentMethods->count() > 0)
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Expenses Count</th>
                            <th>Created</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paymentMethods as $method)
                        <tr>
                            <td class="fw-bold">{{ $method->name }}</td>
                            <td>
                                <span class="badge bg-info">{{ $method->expenses_count }}</span>
                            </td>
                            <td>{{ $method->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('payment_methods.edit', $method) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('payment_methods.destroy', $method) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure? This will delete all associated expenses.')">
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

    {{ $paymentMethods->links() }}
@else
    <div class="text-center py-5">
        <i class="bi bi-credit-card display-1 text-muted"></i>
        <h3 class="mt-3">No payment methods found</h3>
        <p class="text-muted">Add payment methods to track how you pay for expenses.</p>
        <a href="{{ route('payment_methods.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Your First Payment Method
        </a>
    </div>
@endif
@endsection