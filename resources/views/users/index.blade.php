@extends('layouts.app')

@section('title', 'Users')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    .page-header h1 {
        font-weight: 700;
        font-size: 1.5rem;
        color: #1f2937;
        margin: 0;
    }
    .btn-primary {
        background: #db2763;
        border: none;
        border-radius: 0.6rem;
        font-weight: 600;
        padding: 0.5rem 1.1rem;
    }
    .btn-primary:hover {
        background: #b91c4f;
    }

    .search-form .form-control {
        border-radius: 0.6rem 0 0 0.6rem;
        border: 1px solid #e5e7eb;
        padding: 0.6rem 0.9rem;
    }
    .search-form .form-control:focus {
        border-color: #db2763;
        box-shadow: 0 0 0 0.2rem rgba(219, 39, 99, 0.12);
    }
    .search-form .btn-outline-secondary {
        border-radius: 0 0.6rem 0.6rem 0;
        border: 1px solid #e5e7eb;
        border-left: none;
        color: #db2763;
    }
    .search-form .btn-outline-secondary:hover {
        background: #fdecf1;
        color: #db2763;
    }

    .table-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        padding: 1.25rem;
        overflow-x: auto;
    }
    .table-card table {
        margin-bottom: 0.5rem;
    }
    .table-card thead th {
        font-size: 0.8rem;
        color: #9ca3af;
        font-weight: 600;
        border-bottom: 1px solid #f1e3e8;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    .table-card tbody td {
        font-size: 0.9rem;
        color: #374151;
        vertical-align: middle;
    }

    .role-badge {
        display: inline-block;
        padding: 0.25rem 0.7rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .role-badge.admin { background: #fdecf1; color: #db2763; }
    .role-badge.kasir { background: #e0f2fe; color: #0369a1; }

    .btn-warning {
        background: #fbbf24;
        border: none;
        border-radius: 0.5rem;
        color: #1f2937;
        font-weight: 600;
    }
    .btn-danger {
        background: #ef4444;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
    }
</style>

<div class="page-header">
    <h1>Halaman Users</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create</a>
</div>

<form action="{{ route('admin.users') }}" method="GET" class="mb-3 search-form">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Search username or email"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<div class="table-card">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $users->firstItem() + $loop->index }}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td><span class="role-badge {{ $user->role->name }}">{{$user->role->name}}</span></td>
            <td>
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                    Edit akun
                </a>
                <form action="{{ route('admin.users.destroy', $user) }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $users->links() }}
</div>

@endsection