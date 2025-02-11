@extends('layouts.app')
@section('title', 'Roles')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Table {{ __('Roles') }}</h5>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Add Role</a>
        </div>

        <div class="card-body">
            <form method="GET" action="{{ route('roles.search') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search role..."
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <svg width="16" height="16">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-search') }}"></use>
                        </svg>
                        Search
                    </button>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Role</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary btn-sm">
                                        <svg width="16" height="16">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                                        </svg>
                                    </a>
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('roles.destroy', $role) }}" class="btn btn-danger btn-sm"
                                            data-confirm-delete="true">
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
            {{ $roles->links() }}
        </div>
    </div>
@endsection
