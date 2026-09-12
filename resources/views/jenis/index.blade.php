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

    .alert-danger, .alert-success {
        border: none;
        border-radius: 0.75rem;
        padding: 0.9rem 1.25rem;
        margin-bottom: 1.25rem;
        font-size: 0.9rem;
        font-weight: 500;
    }
    .alert-danger { background: #fee2e2; color: #b91c1c; }
    .alert-success { background: #d1fae5; color: #047857; }

    /* Custom modal konfirmasi */
    .custom-modal-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.45);
        z-index: 1050;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    .custom-modal-overlay.active {
        display: flex;
    }
    .custom-modal-box {
        background: #fff;
        border-radius: 1rem;
        width: 100%;
        max-width: 380px;
        overflow: hidden;
    }
    .custom-modal-header {
        background: #fdecf1;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .custom-modal-header h5 {
        margin: 0;
        font-weight: 700;
        color: #db2763;
        font-size: 1.05rem;
    }
    .custom-modal-close {
        background: none;
        border: none;
        font-size: 1.4rem;
        line-height: 1;
        color: #db2763;
        cursor: pointer;
    }
    .custom-modal-body {
        padding: 1.5rem;
        text-align: center;
    }
    .custom-modal-body p {
        color: #374151;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }
    .custom-modal-actions {
        display: flex;
        gap: 0.75rem;
    }
    .custom-modal-actions button {
        flex: 1;
        border: none;
        border-radius: 0.6rem;
        padding: 0.6rem;
        font-weight: 600;
    }
    .btn-modal-cancel {
        background: #f3f4f6;
        color: #374151;
    }
    .btn-modal-cancel:hover {
        background: #e5e7eb;
    }
    .btn-modal-confirm {
        background: #db2763;
        color: #fff;
    }
    .btn-modal-confirm:hover {
        background: #b91c4f;
    }
</style>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

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
                    <button type="button" class="btn btn-danger" onclick="openConfirmModal('jenis{{ $item->id }}')">
                        Hapus
                    </button>
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

{{-- Modal konfirmasi hapus, satu per jenis --}}
@foreach($jenis as $item)
<div class="custom-modal-overlay" id="confirmModal-jenis{{ $item->id }}">
  <div class="custom-modal-box">
    <div class="custom-modal-header">
        <h5>Hapus Jenis</h5>
        <button type="button" class="custom-modal-close" onclick="closeConfirmModal('jenis{{ $item->id }}')">&times;</button>
    </div>
    <div class="custom-modal-body">
        <p>Apakah anda yakin akan menghapus jenis "{{ $item->nama }}"?</p>
        <div class="custom-modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeConfirmModal('jenis{{ $item->id }}')">Batal</button>
            <button type="button" class="btn-modal-confirm" onclick="document.getElementById('deleteForm-jenis{{ $item->id }}').submit()">Ya, Hapus</button>
        </div>
    </div>
  </div>
</div>

<form action="{{ route('jenis.destroy', $item) }}" method="POST" id="deleteForm-jenis{{ $item->id }}" style="display:none;">
    @csrf
    @method('DELETE')
</form>
@endforeach

<script>
    function openConfirmModal(id) {
        document.getElementById('confirmModal-' + id).classList.add('active');
    }
    function closeConfirmModal(id) {
        document.getElementById('confirmModal-' + id).classList.remove('active');
    }
</script>

@endsection