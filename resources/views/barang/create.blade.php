@extends('layouts.app')
@section('title', 'Create Barang')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Barang</h5>
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" name="stok" id="stok" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="hargaBeli" class="form-label">Harga Beli</label>
                        <input type="number" step="0.01" name="hargaBeli" id="hargaBeli" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="hargaJual" class="form-label">Harga Jual</label>
                        <input type="number" step="0.01" name="hargaJual" id="hargaJual" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_id" class="form-label">Jenis</label>
                        <select name="jenis_id" id="jenis_id" class="form-select" aria-label="Default select example"
                            required>
                            @foreach ($jenis as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="satuan_id" class="form-label">Satuan</label>
                        <select name="satuan_id" id="satuan_id" class="form-select" aria-label="Default select example"
                            required>
                            @foreach ($satuan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-select" aria-label="Default select example"
                            required>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
