<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
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
        <img src="https://via.placeholder.com/140" alt="Foto Profil" class="about-avatar">

        <div class="about-name">Nama Kamu</div>
        <div class="about-role">Siswa RPL &middot; Pengembang Nyamnyam Shop</div>

        <div class="about-section-title">Tentang Saya</div>
        <p class="about-text">
            Tulis deskripsi singkat tentang diri kamu di sini. Misalnya: siswa jurusan
            Rekayasa Perangkat Lunak yang membangun aplikasi Point of Sale (POS) ini
            sebagai proyek Uji Kompetensi (Ujikom).
        </p>

        <div class="about-section-title">Tentang Aplikasi</div>
        <p class="about-text">
            Nyamnyam Shop adalah aplikasi kasir sederhana berbasis Laravel yang digunakan
            untuk mengelola produk, jenis produk, dan transaksi penjualan.
        </p>

        <div class="about-section-title">Tools &amp; Teknologi</div>
        <ul class="about-list">
            <li>Laravel {{ app()->version() }}</li>
            <li>Bootstrap</li>
            <li>MySQL</li>
        </ul>

        <div class="about-section-title">Kontak</div>
        <div class="about-contact">
            <a href="mailto:emailkamu@example.com">emailkamu@example.com</a>
            <a href="https://github.com/username-kamu" target="_blank">GitHub</a>
        </div>

        @auth
        <a href="{{ route('dashboard') }}" class="about-back">&larr; Kembali ke Dashboard</a>
        @endauth

    </div>

</body>
</html>