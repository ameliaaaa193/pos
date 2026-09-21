@extends('layouts.app')

@section('title', 'Produk')

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
    .table-card tbody td,
    .table-card tbody th {
        font-size: 0.9rem;
        color: #374151;
        vertical-align: middle;
    }
    .table-card .img-thumbnail {
        border-radius: 0.6rem;
        border: 1px solid #f1e3e8;
        display: block;
    }

    .jenis-badge {
        display: inline-block;
        padding: 0.25rem 0.7rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
        background: #fdecf1;
        color: #db2763;
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

    .alert-danger {
        background: #fee2e2;
        color: #b91c1c;
        border: none;
        border-radius: 0.75rem;
        padding: 0.9rem 1.25rem;
        margin-bottom: 1.25rem;
        font-size: 0.9rem;
        font-weight: 500;
    }

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
    <h1>Produk</h1>
    @can('create', App\Models\Produk::class)
    <a href="{{ route('produk.create') }}" method="GET" class="btn btn-primary">create</a>
    @endcan
</div>

<form action="{{ route('produk.index') }}" method="GET" class="mb-3 search-form">
    <div class="input-group">
        <input
         type="text"
         name="search"
         value=""
         class="form-control"
         placeholder="Search nama produk"
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
          <th scope="col">User</th>
          <th scope="col">Foto</th>
          <th scope="col">Nama</th>
          <th scope="col">Jenis</th>
          <th scope="col">Harga Beli</th>
          <th scope="col">Harga Jual</th>
          <th scope="col">Stok</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($products as $product)
        <tr>
          <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
          <td>{{ $product->user->name }}</td>
          <td>
            <img src="{{ asset('storage/'.$product->foto) }}"
                    width="100"
                    class="img-thumbnail">
          </td>
          <td>{{ $product->nama }}</td>
          <td>
            @if($product->jenis)
                <span class="jenis-badge">{{ $product->jenis->nama }}</span>
            @else
                <span class="text-muted">-</span>
            @endif
          </td>
          <td>{{ $product->harga_beli }}</td>
          <td>{{ $product->harga_jual }}</td>
          <td>{{ $product->stok }} pcs</td>
          <td>
            @can('update', $product)
            <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning me-1">Edit</a>
            @endcan
            @can('delete', $product)
            <button type="button" class="btn btn-danger" onclick="openConfirmModal('produk{{ $product->id }}')">Hapus</button>
            @endcan
          </td>
        </tr>
        @empty
          <tr>
            <td colspan="9"><h1>Data tidak tersedia.</h1></td>
          </tr>
        @endforelse
      </tbody>
    </table>
    {{ $products->links() }}
</div>

{{-- Modal konfirmasi hapus, satu per produk --}}
@foreach($products as $product)
<div class="custom-modal-overlay" id="confirmModal-produk{{ $product->id }}">
  <div class="custom-modal-box">
    <div class="custom-modal-header">
        <h5>Hapus Produk</h5>
        <button type="button" class="custom-modal-close" onclick="closeConfirmModal('produk{{ $product->id }}')">&times;</button>
    </div>
    <div class="custom-modal-body">
        <p>Apakah anda yakin akan menghapus produk "{{ $product->nama }}"?</p>
        <div class="custom-modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeConfirmModal('produk{{ $product->id }}')">Batal</button>
            <button type="button" class="btn-modal-confirm" onclick="document.getElementById('deleteForm-produk{{ $product->id }}').submit()">Ya, Hapus</button>
        </div>
    </div>
  </div>
</div>

<form action="{{ route('produk.destroy', $product) }}" method="POST" id="deleteForm-produk{{ $product->id }}" style="display:none;">
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