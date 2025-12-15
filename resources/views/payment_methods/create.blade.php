@extends('layouts.app')

@section('title', 'Add Payment Method - Cheqa')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Add New Payment Method</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('payment_methods.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Payment Method Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Save Payment Method
                        </button>
                        <a href="{{ route('payment_methods.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection