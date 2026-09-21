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

    .detail-table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: #9ca3af;
        font-weight: 600;
        border-bottom: 1px solid #f1e3e8;
        padding: 0.6rem 0.75rem;
        white-space: nowrap;
    }
    .detail-table tbody td {
        font-size: 0.9rem;
        color: #374151;
        vertical-align: middle;
        padding: 0.6rem 0.75rem;
        border-bottom: 1px solid #f6eef2;
    }
    .detail-table tbody tr:last-child td { border-bottom: none; }
    .detail-table tbody tr:hover { background: #fdfafb; }
    .detail-table .text-end { text-align: right; }
    .detail-table .text-center { text-align: center; }
    .payment-badge {
        display: inline-block;
        padding: 0.25rem 0.7rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .payment-badge.cash { background: #d1fae5; color: #047857; }
    .payment-badge.qris { background: #dbeafe; color: #1d4ed8; }

    /* klik card cash/non-tunai untuk toggle tabel detail transaksi */
    .stat-card.clickable { cursor: pointer; transition: box-shadow 0.15s ease-in-out; }
    .stat-card.clickable:hover { box-shadow: 0 4px 20px rgba(219, 39, 99, 0.15); }
    .detail-transaksi-section { display: none; }
    .detail-transaksi-section.show { display: block; }
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
            <div class="card stat-card clickable" onclick="toggleDetailTransaksi()">
                <div class="card-header"><span class="stat-icon green"><i class="bi bi-cash-coin"></i></span> Total pembayaran tunai</div>
                <div class="card-body"><h5 class="card-title">Rp {{ number_format($ringkasan['total_cash']) }}</h5></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card stat-card clickable" onclick="toggleDetailTransaksi()">
                <div class="card-header"><span class="stat-icon orange"><i class="bi bi-credit-card"></i></span> Total pembayaran non-tunai</div>
                <div class="card-body"><h5 class="card-title">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h5></div>
            </div>
        </div>
    </div>

    <div class="info-card mb-3 detail-transaksi-section" id="detailTransaksiSection">
        <h3>Detail Transaksi - Produk yang Dibeli</h3>
        <div class="table-responsive">
            <table class="table detail-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Waktu</th>
                        <th>Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Harga</th>
                        <th class="text-end">Subtotal</th>
                        <th class="text-center">Metode Bayar</th>
                        <th>Kasir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksiHariIni as $idx => $transaksi)
                        <tr>
                            <td>{{ $idx + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->format('H:i:s') }}</td>
                            <td>{{ $transaksi->produk_nama }}</td>
                            <td class="text-center">{{ $transaksi->kuantitas }}</td>
                            <td class="text-end">Rp {{ number_format($transaksi->harga_jual) }}</td>
                            <td class="text-end"><strong>Rp {{ number_format($transaksi->subtotal) }}</strong></td>
                            <td class="text-center">
                                @if($transaksi->metode_pembayaran === 'CASH')
                                    <span class="payment-badge cash">Cash</span>
                                @else
                                    <span class="payment-badge qris">QRIS</span>
                                @endif
                            </td>
                            <td>{{ $transaksi->kasir_name }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-muted py-3">Belum ada transaksi hari ini</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endcan

    <div class="section-title"><i class="bi bi-exclamation-triangle"></i> Critical Inventory Status</div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="info-card">
                <h3>Daftar produk stok rendah</h3>
                <div class="table-responsive">
                    <table class="table detail-table">
                        <thead><tr><th>#</th><th>Nama</th><th class="text-center">Stok</th></tr></thead>
                        <tbody>
                            @forelse ($produkStokRendah as $index => $produk)
                                <tr>
                                    <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                                    <td>{{ $produk->nama }}</td>
                                    <td class="text-center">{{ $produk->stok }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-muted text-center py-3">Seluruh produk berada dalam kondisi stok aman.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $produkStokRendah->links() }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="info-card">
                <h3>Produk habis stok</h3>
                <div class="table-responsive">
                    <table class="table detail-table">
                        <thead><tr><th>#</th><th>Nama</th><th class="text-center">Stok</th></tr></thead>
                        <tbody>
                            @forelse ($produkStokHabis as $index => $produk)
                                <tr>
                                    <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                                    <td>{{ $produk->nama }}</td>
                                    <td class="text-center">{{ $produk->stok }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-muted text-center py-3">Seluruh produk berada dalam kondisi stok aman.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="section-title"><i class="bi bi-star"></i> Best Seller Products</div>
    <div class="row g-3">
        <div class="col-md-12">
            <div class="info-card">
                <div class="table-responsive">
                    <table class="table detail-table">
                        <thead><tr><th>#</th><th>Nama</th><th class="text-center">Terjual</th></tr></thead>
                        <tbody>
                            @forelse ($produkTerlaris as $index => $produk)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $produk->nama }}</td>
                                    <td class="text-center">{{ $produk->total_terjual }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-muted text-center py-3">Belum ada produk terjual hari ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDetailTransaksi() {
        const section = document.getElementById('detailTransaksiSection');
        section.classList.toggle('show');
        if (section.classList.contains('show')) {
            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
</script>

@endsection