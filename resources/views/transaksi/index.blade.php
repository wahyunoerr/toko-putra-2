@extends('layouts.app')
@section('title', 'Data Transaksi')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Table {{ __('Data Transaksi') }}</h5>
            <div>
                <a href="{{ route('transaksi-pos.filter') }}" class="btn btn-secondary">Filter</a>
                <a href="{{ route('pos.index') }}" class="btn btn-primary">Add Transaction</a>
            </div>
        </div>

        <div class="card-body">
            <form method="GET" action="{{ route('transaksi-pos.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search transaction..."
                        value="{{ request('q') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <svg width="16" height="16">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-search') }}"></use>
                        </svg>
                        Search
                    </button>
                    <a href="{{ route('transaksi-pos.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Kostumer</th>
                            <th>Total</th>
                            <th>Tanggal Transaksi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->kode_transaksi }}</td>
                                <td>{{ $transaction->details->first()->customer->name }}</td>
                                <td>Rp. {{ number_format($transaction->total_belanja, 2, ',', '.') }}</td>
                                <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('transaksi.show', $transaction->id) }}" class="btn btn-info btn-sm">
                                        <svg width="16" height="16">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-info') }}"></use>
                                        </svg>
                                    </a>
                                    <form action="{{ route('transaksi-pos.destroy', $transaction) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('transaksi-pos.destroy', $transaction) }}"
                                            class="btn btn-danger btn-sm" data-confirm-delete="true">
                                            <svg width="16" height="16">
                                                <use xlink:href="{{ asset('icons/coreui.svg#cil-trash') }}"></use>
                                            </svg>
                                        </a>
                                    </form>
                                    <a href="{{ route('transaksi-pos.invoice', $transaction->id) }}"
                                        class="btn btn-primary btn-sm">
                                        <svg width="16" height="16">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-file') }}"></use>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="text-center">No data available</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-center">
            {{ $transactions->links() }}
        </div>
    </div>
@endsection
