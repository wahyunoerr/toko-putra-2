@extends('layouts.app')
@section('title', 'Jenis Barang')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Jenis Barang</h5>
                <a href="{{ route('jenis-barang.index') }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('jenis-barang.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
