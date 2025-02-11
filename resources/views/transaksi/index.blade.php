@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Data Transaksi</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kostumer</th>
                    <th>Barang</th>
                    <th>Quantity</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->customer_name }}</td>
                        <td>{{ $transaction->barang->name }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>Rp. {{ number_format($transaction->barang->hargaJual, 2, ',', '.') }}</td>
                        <td>Rp. {{ number_format($transaction->quantity * $transaction->barang->hargaJual, 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
