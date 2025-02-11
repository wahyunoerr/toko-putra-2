@extends('layouts.app')
@section('title', 'Barang')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Table {{ __('Barang') }}</h5>
            <a href="{{ route('barang.create') }}" class="btn btn-primary">Add Barang</a>
        </div>

        <div class="card-body">
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif
            <form method="GET" action="{{ route('barang.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search barang..."
                        value="{{ request('q') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <svg width="16" height="16">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-search') }}"></use>
                        </svg>
                        Search
                    </button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga Beli Barang</th>
                            <th scope="col">Harga Beli Per Item</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangs as $barang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $barang->name }}</td>
                                <td>
                                    {{ $barang->stok }}
                                    @if ($barang->stok < 10)
                                        <span class="badge bg-warning text-dark">Low Stock</span>
                                    @endif
                                </td>
                                <td>Rp. {{ number_format($barang->hargaBeli, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($barang->hargaBeli / $barang->stok, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($barang->hargaJual, 0, ',', '.') }}</td>
                                <td>{{ $barang->jenis->nama }}</td>
                                <td>{{ $barang->satuan->nama }}</td>
                                <td>{{ $barang->supplier->name }}</td>
                                <td>
                                    <a href="{{ route('barang.edit', $barang) }}" class="btn btn-primary btn-sm">
                                        <svg width="16" height="16">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                                        </svg>
                                    </a>
                                    <form action="{{ route('barang.destroy', $barang) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" data-confirm-delete="true">
                                            <svg width="16" height="16">
                                                <use xlink:href="{{ asset('icons/coreui.svg#cil-trash') }}"></use>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    <div class="text-center">No data available</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{ $barangs->links() }}
        </div>
    </div>
@endsection
