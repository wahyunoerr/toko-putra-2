@extends('layouts.app')
@section('title', 'Satuan Barang')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Table {{ __('Satuan Barang') }}</h5>
            <a href="{{ route('satuan-barang.create') }}" class="btn btn-primary">Add Satuan Barang</a>
        </div>

        <div class="card-body">
            <form method="GET" action="{{ route('satuan-barang.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search satuan barang..."
                        value="{{ request('q') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <svg width="16" height="16">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-search') }}"></use>
                        </svg>
                        Search
                    </button>
                    <a href="{{ route('satuan-barang.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Satuan Barang</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($satuanBarangs as $satuan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $satuan->nama }}</td>
                                <td>
                                    <a href="{{ route('satuan-barang.edit', $satuan) }}" class="btn btn-primary btn-sm">
                                        <svg width="16" height="16">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                                        </svg>
                                    </a>
                                    <form action="{{ route('satuan-barang.destroy', $satuan) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('satuan-barang.destroy', $satuan) }}"
                                            class="btn btn-danger btn-sm" data-confirm-delete="true">
                                            <svg width="16" height="16">
                                                <use xlink:href="{{ asset('icons/coreui.svg#cil-trash') }}"></use>
                                            </svg>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <div class="text-center">No data available</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{ $satuanBarangs->links() }}
        </div>
    </div>
@endsection
