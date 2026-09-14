<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f9fafb;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            padding: 2.5rem 1rem;
        }

        .about-card {
            background: #fff;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            padding: 2rem;
            max-width: 700px;
            margin: 0 auto;
        }

        .about-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fdecf1;
            display: block;
            margin: 0 auto 1.25rem;
        }

        .about-name {
            text-align: center;
            font-weight: 700;
            font-size: 1.5rem;
            color: #1f2937;
            margin-bottom: 0.25rem;
        }

        .about-role {
            text-align: center;
            color: #db2763;
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .about-section-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #9ca3af;
            font-weight: 700;
            margin-bottom: 0.5rem;
            margin-top: 1.5rem;
        }

        .about-text {
            color: #374151;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .about-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .about-list li {
            color: #374151;
            font-size: 0.9rem;
            padding: 0.35rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .about-list li::before {
            content: "•";
            color: #db2763;
            font-weight: 700;
        }

        .about-contact {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 0.5rem;
        }
        .about-contact a {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: #fdecf1;
            color: #db2763;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.4rem 0.9rem;
            border-radius: 999px;
        }
        .about-contact a:hover {
            background: #db2763;
            color: #fff;
        }

        .about-back {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #9ca3af;
            text-decoration: none;
        }
        .about-back:hover {
            color: #db2763;
        }
    </style>
</head>
<body>

    <div class="about-card">

        {{-- Ganti src dengan foto kamu, atau hapus tag img ini kalau tidak perlu --}}
        {{-- <img src="https://via.placeholder.com/140" alt="Foto Profil" class="about-avatar"> --}}

        <div class="about-name">Nyamnyam Shop</div>
        {{-- <div class="about-role">Siswa RPL &middot; Pengembang Nyamnyam Shop</div> --}}

        <div class="about-section-title">Tentang Aplikasi</div>
        <p class="about-text">
         Nyamnyam Shop adalah usaha kuliner yang bergerak di bidang penjualan makanan dan jajanan siap saji,
          dengan tagline "Kulineran Yuk!". Usaha ini menyediakan berbagai produk makanan seperti bakso 
          dan jajanan lainnya yang dikategorikan berdasarkan jenis produk untuk memudahkan pelanggan dalam memilih.
          Seiring berkembangnya jumlah transaksi dan pelanggan, Nyamnyam Shop mulai mengalami kendala dalam pencatatan penjualan 
          yang masih dilakukan secara manual, sehingga sering terjadi kesalahan pencatatan, sulitnya rekapitulasi laporan penjualan harian,
          serta lambatnya proses transaksi di kasir
        </p>

        <div class="about-section-title">Proses Bisnis Sebelum Adanya Sistem</div>
        <p class="about-text">
        Sebelumnya, seluruh proses transaksi di Nyamnyam Shop dilakukan secara manual menggunakan nota kertas. Kasir mencatat
            setiap pesanan pelanggan satu per satu, kemudian menghitung total pembayaran secara manual. Hal ini menimbulkan beberapa masalah, di antaranya:
            Rentan terjadi kesalahan hitung total pembayaran dan kembalian.
            Data penjualan sulit direkap menjadi laporan harian/bulanan.
            Tidak ada pencatatan status transaksi (selesai, dibatalkan, dsb) secara jelas.
            Proses pelayanan pelanggan menjadi lebih lambat saat jam ramai.
        </p>

        <div class="about-section-title">Alasan Dibutuhkan Sistem Aplikasi</div>
        <p class="about-text">
            Berdasarkan permasalahan tersebut, dibutuhkan sebuah sistem aplikasi Point of Sale (POS) berbasis web yang dapat:
                Mencatat transaksi penjualan secara otomatis dan real-time.
                Mengelola data produk dan jenis produk dengan mudah.
                Menghitung total pembayaran secara otomatis sehingga meminimalisir human error.
                Menyediakan riwayat dan status transaksi (Open, Completed, Pending, Cancelled).
                Memberikan laporan penjualan yang dapat diakses oleh admin/owner kapan saja.
        </p>

        <div class="about-section-title">Tools &amp; Teknologi</div>
        <ul class="about-list">
            <li>Laravel {{ app()->version() }}</li>
            <li>Bootstrap</li>
            <li>MySQL</li>
        </ul>

        {{-- <div class="about-section-title">Kontak</div> --}}
        {{-- <div class="about-contact">
            <a href="mailto:emailkamu@example.com">emailkamu@example.com</a>
            <a href="https://github.com/username-kamu" target="_blank">GitHub</a>
        </div> --}}

        @auth
        <a href="{{ route('dashboard') }}" class="about-back">&larr; Kembali ke Dashboard</a>
        @endauth

    </div>

</body>
</html>