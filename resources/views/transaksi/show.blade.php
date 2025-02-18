@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ __('Detail Transaksi') }} {{ $pos->created_at->format('d/m/Y') }} -
                {{ $pos->details->first()->customer->name }}</h5>
            <a href="{{ route('transaksi-pos.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Barang</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pos->details as $detail)
                            <tr>
                                <td>{{ $detail->barang->name }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>Rp. {{ number_format($detail->sub_total, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" style="text-align:right">Total: </th>
                            <th>Rp. {{ number_format($pos->total_belanja, 2, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
