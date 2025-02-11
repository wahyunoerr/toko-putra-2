@extends('layouts.app')
@section('title', 'Point of Sale')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Point of Sale - {{ session('customer_name') }}</h5>
            <form method="POST" action="{{ route('pos.clearCustomer') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-secondary">Kembali</button>
            </form>
        </div>

        <div class="card-body">
            @if (!session('customer_name'))
                @include('pos.customer')
            @else
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('pos.store') }}" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <label for="barang" class="form-label">Barang</label>
                        <select class="form-control form-select" id="barang" name="barang_id">
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->name }} (Stok: {{ $barang->stok }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            @endif

            <div class="table-responsive mt-4">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $index => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['barang']->name }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>Rp. {{ number_format($item['barang']->hargaJual, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($item['quantity'] * $item['barang']->hargaJual, 0, ',', '.') }}
                                </td>
                                <td>
                                    <form action="{{ route('pos.destroy', $index) }}" method="POST" class="d-inline">
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <h5>Total: Rp. {{ number_format($total, 0, ',', '.') }}</h5>
            <form method="POST" action="{{ route('pos.checkout') }}">
                @csrf
                <button type="submit" class="btn btn-success">Checkout</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#barang').select2({
                placeholder: 'Pilih Barang',
                allowClear: true
            });
        });
    </script>
@endpush
