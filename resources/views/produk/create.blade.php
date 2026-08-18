@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<style>
    .form-page-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .form-page-title {
        font-weight: 700;
        font-size: 1.4rem;
        color: #1f2937;
        margin-bottom: 1.5rem;
        width: 100%;
        max-width: 600px;
    }
    .form-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        padding: 1.75rem 2rem;
        width: 100%;
        max-width: 600px;
    }
</style>

<div class="form-page-wrapper">
    <h4 class="form-page-title">Tambah Produk</h4>

    <div class="form-card">
        <form action="{{ route('produk.store') }}"
              method="POST"
              enctype="multipart/form-data">

        @include('produk._form')

        </form>
    </div>
</div>

@endsection