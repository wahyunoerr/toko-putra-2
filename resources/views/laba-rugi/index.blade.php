@extends('layouts.app')
@section('title', 'Laporan Pendapatan')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Laporan Pendapatan</h5>
        </div>

        <div class="card-body">
            <!-- Form Filter Tanggal -->
            <form method="GET" action="{{ route('laporan-pendapatan') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" class="form-control"
                            value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" id="end_date" name="end_date" class="form-control"
                            value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('laporan-pendapatan') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Cari barang..."
                        value="{{ request('q') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <svg width="16" height="16">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-search') }}"></use>
                        </svg>
                        Search
                    </button>
                    <a href="{{ route('laporan-pendapatan') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <!-- Tabel laporan pendapatan -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Barang</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Total Per Item</th>
                            <th scope="col">Harga Beli Per Item</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
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
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <h3>Total Pendapatan Kotor: Rp. {{ number_format($totalPendapatanKotor, 2, ',', '.') }}</h3>
            <h3>Total Pendapatan Bersih: Rp. {{ number_format($totalPendapatanBersih, 2, ',', '.') }}</h3>
        </div>
    </div>
@endsection