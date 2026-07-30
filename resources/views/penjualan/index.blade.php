@extends('layouts.app')

@section('title', 'Penjualan')

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

    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.7rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .status-badge.COMPLETED { background: #d1fae5; color: #047857; }
    .status-badge.PENDING { background: #fef3c7; color: #b45309; }
    .status-badge.CANCELLED { background: #fee2e2; color: #b91c1c; }

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

@if(session('errors'))
  <div class="alert alert-danger">
      {{ session('errors')}}
  </div>
@endif

<div class="page-header">
    <h1>Halaman Penjualan</h1>
    <a href="{{ route('penjualan.create') }}" class="btn btn-primary">Create</a>
</div>

<form action="{{ route('penjualan.index')}}" method="GET" class="mb-3 search-form">
    <div class="input-group">
        <input
             type="text"
             name="search"
             value="{{ request()->search }}"
             class="form-control"
             placeholder="Search penjualan">
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
          <th scope="col">Tanggal Transaksi</th>
          <th scope="col">Kasir</th>
          <th scope="col">Total Pembayaran</th>
          <th scope="col">Metode Pembayaran</th>
          <th scope="col">Status</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse($sales as $sale)
        <tr>
          <th scope="row">{{$sales->firstItem() + $loop->index}}</th>
          <td>{{$sale->created_at->translatedFormat('d-m-Y H:i:s')}}</td>
          <td>{{$sale->user->name}}</td>
          <td>Rp.{{$sale->total_pembayaran}}</td>
          <td>{{$sale->metode_pembayaran}}</td>
          <td><span class="status-badge {{ $sale->status }}">{{$sale->status}}</span></td>
          <td class="d-flex gap-1">
            <a href="" class="btn btn-primary">Detail</a>
            @can('view', $sale)
            <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-warning">Edit</a>
            @endcan
            @can('delete', $sale)
            <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                    Hapus
                </button>
            </form>
            @endcan
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6">Data Tidak Ditemukan</td>
        </tr>
        @endforelse
      </tbody>
    </table>
    {{$sales->links()}}
</div>

@endsection