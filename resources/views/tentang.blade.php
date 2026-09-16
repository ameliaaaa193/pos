@extends('layouts.app')

@section('title', 'Tentang')

@section('content')

<style>
    .about-header {
        margin-bottom: 1.5rem;
    }
    .about-header h1 {
        font-weight: 700;
        font-size: 1.5rem;
        color: #1f2937;
    }

   .about-card {
    background: #fff;
    border-radius: 1rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.04);
    padding: 2.5rem;
    max-width: 100%;
    width: 100%;
    }
    
    .about-logo {
        width: 64px;
        height: 64px;
        border-radius: 1rem;
        background: #db2763;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    .about-card h2 {
        font-weight: 700;
        color: #1f2937;
        font-size: 1.4rem;
        margin-bottom: 0.25rem;
    }

    .about-card .version-badge {
        display: inline-block;
        background: #fdecf1;
        color: #db2763;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        margin-bottom: 1.25rem;
    }

    .about-card p.description {
        color: #4b5563;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .about-section-title {
        font-weight: 700;
        color: #1f2937;
        font-size: 1rem;
        margin-bottom: 0.75rem;
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0 0 1.5rem;
    }
    .feature-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.6rem;
        padding: 0.5rem 0;
        color: #374151;
        font-size: 0.9rem;
        border-bottom: 1px solid #f1e3e8;
    }
    .feature-list li:last-child {
        border-bottom: none;
    }
    .feature-list i {
        color: #db2763;
        margin-top: 0.15rem;
    }

    .about-footer {
        border-top: 1px solid #f1e3e8;
        padding-top: 1.25rem;
        color: #9ca3af;
        font-size: 0.8rem;
    }
</style>

<div class="about-header">
    <h1>Tentang Aplikasi</h1>
</div>

<div class="about-card">
    <div class="about-logo">
        <i class="bi bi-cup-straw"></i>
    </div>

    <h2>Nyamnyam Shop</h2>
    <span class="version-badge">Versi 1.0.0</span>

    <p class="description">
        Nyamnyam Shop adalah aplikasi Point of Sale (POS) berbasis web yang dibangun untuk membantu
        pelaku usaha kuliner dalam mengelola transaksi penjualan, data produk, kategori produk, dan
        pengguna secara digital, terpusat, dan mudah digunakan.
    </p>

    <div class="about-section-title">Fitur Utama</div>
    <ul class="feature-list">
        <li><i class="bi bi-check-circle-fill"></i> Manajemen pengguna dengan pembagian hak akses (admin & kasir)</li>
        <li><i class="bi bi-check-circle-fill"></i> Manajemen kategori (jenis) dan data produk</li>
        <li><i class="bi bi-check-circle-fill"></i> Transaksi penjualan dengan metode pembayaran Cash & QRIS</li>
        <li><i class="bi bi-check-circle-fill"></i> Perhitungan otomatis uang diterima dan kembalian</li>
        <li><i class="bi bi-check-circle-fill"></i> Dashboard ringkasan penjualan harian dan status stok</li>
        <li><i class="bi bi-check-circle-fill"></i> Riwayat transaksi lengkap dengan detail item yang dibeli</li>
    </ul>

    <div class="about-footer">
        Dibangun menggunakan Laravel &amp; Bootstrap.<br>
        &copy; {{ date('Y') }} Nyamnyam Shop. All rights reserved.
    </div>
</div>

@endsection