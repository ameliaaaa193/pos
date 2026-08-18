@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    .dashboard-header { margin-bottom: 1.5rem; }
    .dashboard-header h1 { font-weight: 700; font-size: 1.5rem; color: #1f2937; }
    .dashboard-header small { font-size: 1rem; font-weight: 400; }
    .section-title { display: flex; align-items: center; gap: 0.5rem; font-size: 1.1rem; font-weight: 700; color: #1f2937; margin: 1.75rem 0 1rem; }
    .section-title i { color: #db2763; }
    .stat-card { background: #fff; border: none; border-radius: 1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.04); height: 100%; }
    .stat-card .card-header { background: transparent; border: none; display: flex; align-items: center; gap: 0.6rem; color: #6b7280; font-size: 0.85rem; font-weight: 600; padding: 1.1rem 1.25rem 0; }
    .stat-card .card-body { padding: 0.5rem 1.25rem 1.25rem; }
    .stat-card .card-title { font-weight: 700; color: #1f2937; font-size: 1.4rem; margin: 0; }
    .stat-icon { width: 32px; height: 32px; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-size: 0.95rem; color: #fff; flex-shrink: 0; }
    .stat-icon.pink { background: #db2763; }
    .stat-icon.purple { background: #8b5cf6; }
    .stat-icon.green { background: #10b981; }
    .stat-icon.orange { background: #f59e0b; }
    .info-card { background: #fff; border: none; border-radius: 1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.04); padding: 1.25rem; height: 100%; }
    .info-card h3 { font-size: 1rem; font-weight: 700; color: #1f2937; margin-bottom: 1rem; }
    .info-card .table { margin-bottom: 0.5rem; }
    .info-card .table thead th { font-size: 0.8rem; color: #9ca3af; font-weight: 600; border-bottom: 1px solid #f1e3e8; }
    .info-card .table td { font-size: 0.9rem; color: #374151; vertical-align: middle; }
</style>

<div class="dashboard-header">
    <h1>
        Ringkasan Hari Ini
        <small class="text-muted">{{ $tanggalHariIni->translatedFormat('l, d F Y') }}</small>
    </h1>

    @can('viewAny', App\Models\User::class)
    <div class="section-title"><i class="bi bi-graph-up-arrow"></i> Today's Sales</div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card stat-card">
                <div class="card-header"><span class="stat-icon pink"><i class="bi bi-bag"></i></span> Total Nilai Penjualan Hari ini</div>
                <div class="card-body"><h5 class="card-title">Rp {{ number_format($ringkasan['total_penjualan']) }}</h5></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card stat-card">
                <div class="card-header"><span class="stat-icon purple"><i class="bi bi-receipt"></i></span> Jumlah Transaksi Hari ini</div>
                <div class="card-body"><h5 class="card-title">{{ number_format($ringkasan['total_transaksi']) }}</h5></div>
            </div>
        </div>
    </div>

    <div class="section-title"><i class="bi bi-wallet2"></i> Cash & Payment Status</div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card stat-card">
                <div class="card-header"><span class="stat-icon green"><i class="bi bi-cash-coin"></i></span> Total pembayaran tunai</div>
                <div class="card-body"><h5 class="card-title">Rp {{ number_format($ringkasan['total_cash']) }}</h5></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card stat-card">
                <div class="card-header"><span class="stat-icon orange"><i class="bi bi-credit-card"></i></span> Total pembayaran non-tunai</div>
                <div class="card-body"><h5 class="card-title">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h5></div>
            </div>
        </div>
    </div>
    @endcan

    <div class="section-title"><i class="bi bi-exclamation-triangle"></i> Critical Inventory Status</div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="info-card">
                <h3>Daftar produk stok rendah</h3>
                <table class="table">
                    <thead><tr><th scope="col">#</th><th scope="col">Nama</th><th scope="col">Stok</th></tr></thead>
                    <tbody>
                        @forelse ($produkStokRendah as $index => $produk)
                            <tr>
                                <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->stok }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-muted text-center">Seluruh produk berada dalam kondisi stok aman.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $produkStokRendah->links() }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="info-card">
                <h3>Produk habis stok</h3>
                <table class="table">
                    <thead><tr><th scope="col">#</th><th scope="col">Nama</th><th scope="col">Stok</th></tr></thead>
                    <tbody>
                        @forelse ($produkStokHabis as $index => $produk)
                            <tr>
                                <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->stok }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-muted text-center">Seluruh produk berada dalam kondisi stok aman.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="section-title"><i class="bi bi-star"></i> Best Seller Products</div>
    <div class="row g-3">
        <div class="col-md-12">
            <div class="info-card">
                <table class="table">
                    <thead><tr><th scope="col">#</th><th scope="col">Nama</th><th scope="col">Terjual</th></tr></thead>
                    <tbody>
                        @forelse ($produkTerlaris as $index => $produk)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->total_terjual }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-muted text-center">Belum ada produk terjual hari ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection