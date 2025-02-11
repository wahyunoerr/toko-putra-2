@extends('layouts.app')
@section('title', 'Jenis Barang')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Table {{ __('Jenis Barang') }}</h5>
            <a href="{{ route('jenis-barang.create') }}" class="btn btn-primary">Add Jenis Barang</a>
        </div>

        <div class="card-body">
            <form method="GET" action="{{ route('jenis-barang.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search jenis barang..."
                        value="{{ request('q') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <svg width="16" height="16">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-search') }}"></use>
                        </svg>
                        Search
                    </button>
                    <a href="{{ route('jenis-barang.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Barang</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jenisBarangs as $jenisBarang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jenisBarang->nama }}</td>
                                <td>
                                    <a href="{{ route('jenis-barang.edit', $jenisBarang) }}" class="btn btn-primary btn-sm">
                                        <svg width="16" height="16">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                                        </svg>
                                    </a>
                                    <form action="{{ route('jenis-barang.destroy', $jenisBarang) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('jenis-barang.destroy', $jenisBarang) }}"
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
            {{ $jenisBarangs->links() }}
        </div>
    </div>
@endsection
