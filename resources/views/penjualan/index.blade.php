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
    .status-badge.OPEN { background: #dbeafe; color: #1d4ed8; }

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

    /* Custom modal (tanpa Bootstrap JS) */
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
        max-width: 400px;
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
        padding: 1.25rem 1.5rem;
    }

    .detail-meta {
        font-size: 0.8rem;
        color: #6b7280;
    }
    .detail-kasir {
        font-size: 0.9rem;
        color: #1f2937;
        margin: 0.25rem 0 1rem;
    }
    .detail-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: #9ca3af;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .detail-value {
        font-size: 0.9rem;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    .detail-item-table {
        width: 100%;
        font-size: 0.85rem;
        margin-bottom: 0.75rem;
        border-collapse: collapse;
    }
    .detail-item-table td {
        padding: 0.4rem 0;
        border-bottom: 1px solid #f1e3e8;
        color: #374151;
    }
    .detail-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 0.5rem;
        border-top: 1px solid #e5e7eb;
        margin-bottom: 1rem;
        font-weight: 700;
        color: #1f2937;
    }
    .detail-status-message {
        padding: 0.75rem 1rem;
        border-radius: 0.6rem;
        font-size: 0.9rem;
        font-weight: 600;
    }
    .detail-status-message.COMPLETED { background: #d1fae5; color: #047857; }
    .detail-status-message.PENDING { background: #fef3c7; color: #b45309; }
    .detail-status-message.CANCELLED { background: #fee2e2; color: #b91c1c; }
    .detail-status-message.OPEN { background: #dbeafe; color: #1d4ed8; }
</style>

@if(session('errors'))
  <div class="alert alert-danger">
      {{ session('errors')}}
  </div>
@endif

<div class="page-header">
    <h1>Penjualan</h1>
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
            <button type="button" class="btn btn-primary" onclick="openDetailModal({{ $sale->id }})">Detail</button>
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

{{-- Overlay modal custom, di luar tabel --}}
@foreach($sales as $sale)
<div class="custom-modal-overlay" id="detailModal{{ $sale->id }}">
  <div class="custom-modal-box">
    <div class="custom-modal-header">
        <h5>Detail transaksi #{{ $sale->id }}</h5>
        <button type="button" class="custom-modal-close" onclick="closeDetailModal({{ $sale->id }})">&times;</button>
    </div>
    <div class="custom-modal-body">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <span class="detail-meta">{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</span>
            <span class="status-badge {{ $sale->status }}">{{ $sale->status }}</span>
        </div>
        <p class="detail-kasir">Kasir: {{ $sale->user->name }}</p>

        <p class="detail-label">Item Dibeli</p>
        <table class="detail-item-table">
            <tbody>
                @forelse ($sale->itemPenjualan as $item)
                <tr>
                    <td>{{ $item->produk->nama }}</td>
                    <td class="text-center">x{{ $item->kuantitas }}</td>
                    <td class="text-end">Rp{{ number_format($item->subtotal) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-muted text-center">Tidak ada item.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="detail-total-row">
            <span>Total pembayaran</span>
            <span>Rp.{{ number_format($sale->total_pembayaran) }}</span>
        </div>

        <p class="detail-label">Metode pembayaran</p>
        <p class="detail-value">{{ $sale->metode_pembayaran }}</p>

        <div class="detail-status-message {{ $sale->status }}">
            @if($sale->status === 'COMPLETED')
                Transaksi telah selesai.
            @elseif($sale->status === 'PENDING')
                Transaksi masih menunggu pembayaran.
            @elseif($sale->status === 'CANCELLED')
                Transaksi telah dibatalkan.
            @elseif($sale->status === 'OPEN')
                Transaksi masih berlangsung.
            @else
                Status transaksi: {{ $sale->status }}.
            @endif
        </div>
    </div>
  </div>
</div>
@endforeach

<script>
    function openDetailModal(id) {
        document.getElementById('detailModal' + id).classList.add('active');
    }
    function closeDetailModal(id) {
        document.getElementById('detailModal' + id).classList.remove('active');
    }
</script>

@endsection