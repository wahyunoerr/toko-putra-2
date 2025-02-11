@extends('layouts.app')
@section('title', 'Input Customer')
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Input Customer Name</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('pos.setCustomer') }}">
                @csrf
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Nama Kostumer</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                    @if ($errors->has('customer_name'))
                        <div class="text-danger">{{ $errors->first('customer_name') }}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Next</button>
            </form>
        </div>
    </div>
@endsection
