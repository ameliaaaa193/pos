@vite(['resources/css/app.css', 'resoursces/js/app.js'])

@extends('layouts.guest')

@section('title', 'Ini halaman uji coba')

@section('content')

<style>
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f5f6;
        padding: 2rem;
    }

    .login-card {
        width: 100%;
        max-width: 950px;
        border: none;
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.12);
        display: flex;
        flex-direction: row;
        background: #fff;
    }

    /* Panel kiri - branding pink */
    .login-brand {
        flex: 1;
        background: linear-gradient(160deg, #ffd6e0 0%, #ffe8ee 60%);
        color: #1f2937;
        padding: 3rem 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .login-brand::before {
        content: "";
        position: absolute;
        top: 24px;
        left: 24px;
        width: 48px;
        height: 48px;
        background-image: radial-gradient(#fff 2px, transparent 2px);
        background-size: 8px 8px;
        opacity: 0.7;
    }

    .login-brand::after {
        content: "";
        position: absolute;
        bottom: 24px;
        right: 24px;
        width: 48px;
        height: 48px;
        background-image: radial-gradient(#fff 2px, transparent 2px);
        background-size: 8px 8px;
        opacity: 0.7;
    }

    .brand-illustration {
        width: 140px;
        height: 140px;
        margin-bottom: 1.5rem;
        z-index: 1;
    }

    .login-brand h2 {
        font-weight: 700;
        font-size: 1.4rem;
        margin-bottom: 0.25rem;
        color: #1f2937;
        z-index: 1;
    }

    .login-brand h2 .accent {
        color: #db2763;
    }

    .login-brand p {
        color: #6b7280;
        font-size: 0.9rem;
        line-height: 1.6;
        max-width: 260px;
        z-index: 1;
        margin-top: 0.5rem;
    }

    /* Panel kanan - form */
    .login-form-panel {
        flex: 1;
        padding: 3rem 3.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .form-icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #db2763;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .card-header {
        background: transparent;
        border: none;
        padding: 0;
        text-align: center;
        font-weight: 700;
        font-size: 1.4rem;
        color: #1f2937;
        width: 100%;
    }

    .card-header .accent {
        color: #db2763;
    }

    .login-subtitle {
        color: #9ca3af;
        font-size: 0.85rem;
        margin-bottom: 1.75rem;
        text-align: center;
    }

    .card-body {
        padding: 0;
        width: 100%;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
        font-size: 0.85rem;
    }

    .input-group-text {
        background: #fdecf1;
        border: 1px solid #fbcfe0;
        border-right: none;
        color: #db2763;
        border-top-left-radius: 0.6rem;
        border-bottom-left-radius: 0.6rem;
    }

    .form-control {
        border-radius: 0.6rem;
        padding: 0.6rem 0.9rem;
        border: 1px solid #e5e7eb;
    }

    .input-group .form-control {
        border-left: none;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-control:focus {
        border-color: #db2763;
        box-shadow: 0 0 0 0.2rem rgba(219, 39, 99, 0.12);
    }

    .input-group:focus-within .input-group-text {
        border-color: #db2763;
    }

    .form-extra-row {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        font-size: 0.85rem;
        margin: 0.5rem 0 1.25rem;
    }

    .form-extra-row a {
        color: #db2763;
        text-decoration: none;
    }

    .form-extra-row a:hover {
        text-decoration: underline;
    }

    .btn-primary {
        width: 100%;
        background: linear-gradient(90deg, #db2763, #f43f5e);
        border: none;
        border-radius: 0.6rem;
        padding: 0.7rem;
        font-weight: 600;
        transition: all 0.2s ease-in-out;
    }

    .btn-primary:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .login-card {
            flex-direction: column;
        }
        .login-brand {
            padding: 2rem;
        }
        .login-form-panel {
            padding: 2rem;
        }
    }
</style>

<div class="login-wrapper">
    <div class="card login-card">

        <div class="login-brand">
            <svg class="brand-illustration" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="55" y="30" width="90" height="70" rx="10" fill="#f472b6"/>
                <rect x="65" y="40" width="70" height="45" rx="4" fill="#fff"/>
                <rect x="40" y="100" width="120" height="40" rx="8" fill="#ec4899"/>
                <rect x="30" y="110" width="30" height="8" rx="2" fill="#fff" opacity="0.8"/>
                <circle cx="150" cy="150" r="8" fill="#fff" opacity="0.6"/>
            </svg>
            <h2>Selamat Datang di</h2>
            <h2><span class="accent">Aplikasi POS</span></h2>
            <p>Kelola transaksi, produk, dan laporan penjualan dengan mudah dan efisien.</p>
        </div>

        <div class="login-form-panel">
            <div class="form-icon-circle">
                <i class="bi bi-cart3"></i>
            </div>

            <h5 class="card-header">Login <span class="accent">POS</span></h5>
            <p class="login-subtitle">Silakan masuk untuk melanjutkan</p>

            <div class="card-body">
                <form action="{{ route('auth') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Masukkan email Anda" aria-describedby="emailHelp">
                        </div>

                        @error('email')
                            <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Masukkan password Anda">
                        </div>

                        @error('password')
                            <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection