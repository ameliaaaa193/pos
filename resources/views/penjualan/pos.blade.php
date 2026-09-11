@extends('layouts.app')

@section('title', 'Nyamnyam')

@section('content')

<style>
    .pos-title {
        font-weight: 700;
        font-size: 1.4rem;
        color: #1f2937;
    }

    .pos-card {
        background: #fff;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
    }

    .product-search .form-control {
        border-radius: 0.6rem;
        padding: 0.6rem 0.9rem;
        border: 1px solid #e5e7eb;
    }
    .product-search .form-control:focus {
        border-color: #db2763;
        box-shadow: 0 0 0 0.2rem rgba(219, 39, 99, 0.12);
    }

    .product-pick-btn {
        border: 1px solid #fbcfe0 !important;
        color: #374151 !important;
        border-radius: 0.75rem !important;
        background: #fff !important;
        transition: all 0.15s ease-in-out;
    }
    .product-pick-btn:hover {
        background: #fdecf1 !important;
        border-color: #db2763 !important;
    }
    .product-pick-btn img {
        border: 2px solid #fdecf1;
    }
    .product-pick-btn small {
        color: #db2763 !important;
        font-weight: 600;
    }

    .qty-input {
        border-radius: 0.6rem;
        border: 1px solid #e5e7eb;
        text-align: center;
    }
    .qty-input:focus {
        border-color: #db2763;
        box-shadow: 0 0 0 0.2rem rgba(219, 39, 99, 0.12);
    }

    .btn-add-product {
        background: #db2763 !important;
        border: none !important;
        border-radius: 0.6rem !important;
        font-weight: 600;
    }
    .btn-add-product:hover {
        background: #b91c4f !important;
    }

    .cart-table thead th {
        background: #fdecf1;
        color: #db2763;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        border-bottom: none;
    }
    .cart-table tbody td {
        font-size: 0.9rem;
        color: #374151;
        vertical-align: middle;
    }

    .cart-footer {
        background: #fdecf1;
        border-radius: 0 0 1rem 1rem;
        padding: 1.25rem;
    }
    .cart-footer strong {
        display: block;
        font-size: 1.3rem;
        color: #1f2937;
        margin-bottom: 0.75rem;
    }
    .cart-footer .form-select,
    .cart-footer .form-control {
        border-radius: 0.6rem;
        border: 1px solid #fbcfe0;
        padding: 0.6rem 0.9rem;
    }
    .cart-footer .form-select:focus,
    .cart-footer .form-control:focus {
        border-color: #db2763;
        box-shadow: 0 0 0 0.2rem rgba(219, 39, 99, 0.12);
    }

    .cash-info-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 0.3rem;
        display: block;
    }

    .kembalian-box {
        background: #fff;
        border: 1px solid #fbcfe0;
        border-radius: 0.6rem;
        padding: 0.6rem 0.9rem;
        margin-bottom: 0.75rem;
        font-weight: 700;
        font-size: 1.05rem;
    }
    .kembalian-box.negative {
        color: #b91c1c;
        border-color: #fca5a5;
        background: #fef2f2;
    }
    .kembalian-box.positive {
        color: #047857;
        border-color: #a7f3d0;
        background: #ecfdf5;
    }

    .qris-box {
        background: #fff;
        border: 1px solid #fbcfe0;
        border-radius: 0.75rem;
        padding: 1.25rem;
        margin-bottom: 0.75rem;
        text-align: center;
    }
    .qris-box img {
        width: 160px;
        height: 160px;
        margin-bottom: 0.5rem;
    }
    .qris-box p {
        font-size: 0.85rem;
        color: #6b7280;
        margin: 0;
    }
    .qris-box strong {
        display: block;
        font-size: 1rem;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .btn-success {
        background: #10b981 !important;
        border: none !important;
        border-radius: 0.6rem !important;
        font-weight: 600;
        padding: 0.65rem;
    }
    .btn-success:hover {
        background: #059669 !important;
    }

    .btn-outline-danger {
        border-radius: 0.6rem !important;
        font-weight: 600;
        padding: 0.65rem;
    }

    .btn-danger.btn-sm {
        background: #ef4444;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
    }

    /* Custom modal konfirmasi (tanpa Bootstrap JS, tanpa confirm() bawaan browser) */
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

@if (session('errors'))
          <div class="alert alert-danger">
                {{ session('errors') }}
          </div>
@endif

<h4 class="mb-3 pos-title">
    {{ $mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}
</h4>

<div class="row">

<div class="col-md-6">
    <div class="card pos-card">
        <div class="card-body" style="max-height:70vh; overflow:auto">
             <div class="mb-3 product-search">
                <form method="GET" action="{{ route('penjualan.create') }}">
                  <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Cari produk..."
                    onkeyup="this.form.submit()">
                </form>
              </div>  
              @foreach($products as $product)
                <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="col-7">
                  <button class="btn product-pick-btn w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                    <div class="d-flex align-items-center gap-2">

                      <img src="{{ asset('storage/'.$product->foto) }}"
                           alt="Gambar"
                           class="rounded-circle"
                           style="width:45px; height:45px; object-fit:cover;">
                      <div>
                          <div class="fw-semibold">{{ $product->nama }}</div>
                          <small class="text-muted">{{ number_format($product->harga_jual) }}</small>
                      </div>

                    </div>
                  </button>
                </div>

                <div class="col-3">
                  <input type="number" name="quantity" value="1" min="1"
                         class="form-control qty-input {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                </div>

                <div class="col-2">
                    <button class="btn btn-add-product w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">+</button>
                </div>
              </form>
            @endforeach
          </div>
      </div>
  </div>

<div class="col-md-6">
   <div class="card pos-card">
       <table class="table table-bordered mb-0 cart-table">
          <thead>
             <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Aksi</th>
              </tr>  
          </thead>
          <tbody>
            @forelse ($sale->itemPenjualan as $item )
              <tr>
                <td>{{ $item->produk->nama }}</td>
                <td>Rp.{{ number_format($item->produk->harga_jual) }}</td>

                <td>{{ $item->kuantitas }}</td>

                <td>Rp. {{ number_format($item->subtotal) }}</td>
                <td>
                  @can('delete', $item)
                   <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                      @csrf @method('DELETE')
                      <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                    @endcan
                </td>
              </tr>    
              @empty
              <tr>
                <td colspan="4" class="text-center text-muted">
                    Keranjang kosong
                </td>
              </tr>
              @endforelse
          </tbody>
        </table>  

        <div class="cart-footer">
            <strong>Rp {{ number_format($sale->total_pembayaran) }}</strong>

            <form method="POST" 
                  id="checkoutForm"
                  action="{{ route('penjualan.update', $sale->id) }}" 
                  class="mt-2">
              @csrf
              @method('PUT')
              <select name="payment_method" id="paymentMethod" class="form-select mb-2" onchange="togglePaymentUI()">
                <option value="">Pilih Pembayaran</option>
                <option value="CASH">Cash</option>
                <option value="QRIS">QRIS</option>
              </select>

              {{-- Tampil kalau CASH --}}
              <div id="cashSection">
                  <label class="cash-info-label">Uang Diterima</label>
                  <input type="number"
                         id="uangDiterima"
                         class="form-control mb-2"
                         placeholder="Masukkan jumlah uang"
                         min="0"
                         oninput="hitungKembalian()">

                  <div id="kembalianBox" class="kembalian-box">
                      Kembalian: Rp 0
                  </div>
              </div>

              {{-- Tampil kalau QRIS --}}
              <div id="qrisSection" class="qris-box" style="display:none;">
                  <strong>Scan untuk Bayar</strong>
                  <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=POS-PAYMENT-{{ $sale->id }}-{{ $sale->total_pembayaran }}" alt="QR Code Pembayaran">
              </div>

              <button type="button" class="btn btn-success w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}" onclick="openConfirmModal('checkout')">
                 Checkout
              </button>
            </form>
            @can('delete', $sale)
            <form action="{{ route('penjualan.destroy', $sale->id) }}"
                  method="POST"
                  id="batalForm">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="btn btn-outline-danger w-100 mt-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}" onclick="openConfirmModal('batal')">
                      Batal Transaksi
                  </button>
            </form>
            @endcan
        </div>
      </div>
</div>

</div>

{{-- Modal konfirmasi Checkout --}}
<div class="custom-modal-overlay" id="confirmCheckoutModal">
  <div class="custom-modal-box">
    <div class="custom-modal-header">
        <h5>Konfirmasi Checkout</h5>
        <button type="button" class="custom-modal-close" onclick="closeConfirmModal('checkout')">&times;</button>
    </div>
    <div class="custom-modal-body">
        <p>Yakin ingin checkout?</p>
        <div class="custom-modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeConfirmModal('checkout')">Batal</button>
            <button type="button" class="btn-modal-confirm" onclick="document.getElementById('checkoutForm').submit()">Ya, Checkout</button>
        </div>
    </div>
  </div>
</div>

{{-- Modal konfirmasi Batal Transaksi --}}
<div class="custom-modal-overlay" id="confirmBatalModal">
  <div class="custom-modal-box">
    <div class="custom-modal-header">
        <h5>Batalkan Transaksi</h5>
        <button type="button" class="custom-modal-close" onclick="closeConfirmModal('batal')">&times;</button>
    </div>
    <div class="custom-modal-body">
        <p>Apakah Anda yakin ingin membatalkan transaksi ini?</p>
        <div class="custom-modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeConfirmModal('batal')">Tidak</button>
            <button type="button" class="btn-modal-confirm" onclick="document.getElementById('batalForm').submit()">Ya, Batalkan</button>
        </div>
    </div>
  </div>
</div>

<script>
    function hitungKembalian() {
        const totalPembayaran = {{ $sale->total_pembayaran }};
        const uangDiterima = parseInt(document.getElementById('uangDiterima').value) || 0;
        const kembalian = uangDiterima - totalPembayaran;
        const box = document.getElementById('kembalianBox');

        const formatted = new Intl.NumberFormat('id-ID').format(Math.abs(kembalian));

        if (uangDiterima === 0) {
            box.textContent = 'Kembalian: Rp 0';
            box.classList.remove('negative', 'positive');
        } else if (kembalian < 0) {
            box.textContent = 'Uang kurang: Rp ' + formatted;
            box.classList.add('negative');
            box.classList.remove('positive');
        } else {
            box.textContent = 'Kembalian: Rp ' + formatted;
            box.classList.add('positive');
            box.classList.remove('negative');
        }
    }

    function togglePaymentUI() {
        const method = document.getElementById('paymentMethod').value;
        const cashSection = document.getElementById('cashSection');
        const qrisSection = document.getElementById('qrisSection');

        if (method === 'QRIS') {
            cashSection.style.display = 'none';
            qrisSection.style.display = 'block';
        } else {
            cashSection.style.display = 'block';
            qrisSection.style.display = 'none';
        }
    }

    function openConfirmModal(type) {
        if (type === 'checkout') {
            document.getElementById('confirmCheckoutModal').classList.add('active');
        } else if (type === 'batal') {
            document.getElementById('confirmBatalModal').classList.add('active');
        }
    }

    function closeConfirmModal(type) {
        if (type === 'checkout') {
            document.getElementById('confirmCheckoutModal').classList.remove('active');
        } else if (type === 'batal') {
            document.getElementById('confirmBatalModal').classList.remove('active');
        }
    }
</script>

@endsection