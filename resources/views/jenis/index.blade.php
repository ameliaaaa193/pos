@extends('layouts.app')

@section('title', 'Jenis')

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
        width: 100%;
    }

    .table-card thead th {
        font-size: 0.8rem;
        color: #9ca3af;
        font-weight: 600;
        border-bottom: 1px solid #f1e3e8;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        text-align: left;
    }

    .table-card tbody td {
        font-size: 0.9rem;
        color: #374151;
        vertical-align: middle;
    }

    /* Kolom Aksi dibuat sedikit lebih ke tengah */
    .table-card thead th:last-child,
    .table-card tbody td:last-child {
        width: 30%;
        text-align: left;
    }

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
    <h1>Jenis</h1>

    @can('create', App\Models\Jenis::class)
    <a href="{{ route('jenis.create') }}" class="btn btn-primary">Create</a>
    @endcan
</div>

<form action="{{ route('jenis.index') }}" method="GET" class="mb-3 search-form">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Search nama jenis">

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
                <th scope="col">Nama</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($jenis as $index => $item)
            <tr>
                <th scope="row">
                    {{ $jenis->firstItem() + $index }}
                </th>

                <td>
                    {{ $item->nama }}
                </td>

                <td>
                    @can('update', $item)
                    <a href="{{ route('jenis.edit', $item) }}" class="btn btn-warning me-1">
                        Edit
                    </a>
                    @endcan

                    @can('delete', $item)
                    <form action="{{ route('jenis.destroy', $item) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger"
                            onclick="return confirm('Apakah anda yakin akan menghapus jenis ini?')">
                            Hapus
                        </button>
                    </form>
                    @endcan
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="3" class="text-muted text-center">
                    Data tidak tersedia.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $jenis->links() }}
</div>

@endsection