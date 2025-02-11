@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            Edit User
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ $user->roles->first()->name == $role->name ? 'selected' : '' }}>{{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
