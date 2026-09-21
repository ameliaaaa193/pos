<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #1f2937; }
        .header { text-align: center; margin-bottom: 15px; }
        .header h2 { margin: 0; color: #db2763; }
        .header p { margin: 2px 0; color: #6b7280; font-size: 11px; }
        .meta p { margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        table td { padding: 4px 0; border-bottom: 1px dashed #ccc; }
        .total-row td { border-top: 1px solid #000; border-bottom: none; font-weight: bold; padding-top: 6px; }
        .section-label { font-weight: bold; margin-top: 10px; margin-bottom: 3px; text-transform: uppercase; font-size: 10px; color: #6b7280; }
        .footer { text-align: center; margin-top: 20px; padding: 8px; background: #d1fae5; color: #047857; font-weight: bold; border-radius: 4px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Nyamnyam Shop</h2>
        <p>Kulineran Yuk!</p>
    </div>

    <div class="meta">
        <p>Detail transaksi #{{ $sale->id }}</p>
        <p>{{ \Carbon\Carbon::parse($sale->created_at)->translatedFormat('d-m-Y H:i:s') }}</p>
        <p>Kasir: {{ $sale->user->name }}</p>
    </div>

    <div class="section-label">Item Dibeli</div>
    <table>
        @foreach ($sale->itemPenjualan as $item)
        <tr>
            <td>{{ $item->produk->nama }} x{{ $item->kuantitas }}</td>
            <td style="text-align:right;">Rp{{ number_format($item->subtotal) }}</td>
        </tr>
        @endforeach
        <tr class="total-row">
            <td>Total Pembayaran</td>
            <td style="text-align:right;">Rp{{ number_format($sale->total_pembayaran) }}</td>
        </tr>
    </table>

    <div class="section-label">Metode Pembayaran</div>
    <p>{{ $sale->metode_pembayaran }}</p>

    @if($sale->metode_pembayaran === 'CASH')
    <div class="section-label">Uang Diterima</div>
    <p>Rp{{ number_format($sale->uang_diterima) }}</p>

    <div class="section-label">Kembalian</div>
    <p>Rp{{ number_format($sale->kembalian) }}</p>
    @endif

    <div class="footer">
        @if($sale->status === 'COMPLETED')
            Transaksi telah selesai.
        @else
            Status: {{ $sale->status }}
        @endif
    </div>

</body>
</html>