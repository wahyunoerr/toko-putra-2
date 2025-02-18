@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Laporan Pendapatan</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Barang</th>
                    <th>Quantity</th>
                    <th>Harga Jual</th>
                    <th>Total Per Item</th>
                    <th>Harga Beli Per Item</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->barang->name }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>Rp.{{ number_format($transaction->barang->hargaJual, 2, ',', '.') }}</td>
                        <td>Rp.{{ number_format($transaction->barang->hargaJual * $transaction->quantity, 2, ',', '.') }}
                        </td>
                        <td>Rp.{{ number_format($transaction->barang->hargaBeli / $transaction->barang->stok, 2, ',', '.') }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Total Pendapatan Kotor: Rp. {{ number_format($totalPendapatanKotor, 2, ',', '.') }}</h3>
        <h3>Total Pendapatan Bersih: Rp. {{ number_format($totalPendapatanBersih, 2, ',', '.') }}</h3>
    </div>
@endsection
