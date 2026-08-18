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
    <h1>Halaman Produk</h1>
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
          <td>{{ $product->harga_beli }}</td>
          <td>{{ $product->harga_jual }}</td>
          <td>{{ $product->stok }}</td>
          <td>
            @can('update', $product)
            <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning me-1">Edit</a>
            @endcan
            @can('delete', $product)
            <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                    Hapus
                </button>
            </form>
            @endcan
          </td>
        </tr>
        @empty
          <tr>
            <td colspan="8"><h1>Data tidak tersedia.</h1></td>
          </tr>
        @endforelse
      </tbody>
    </table>
    {{ $products->links() }}
</div>

@endsection