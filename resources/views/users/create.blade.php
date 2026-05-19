@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<h4>Tambah User</h4>

<form action=" {{ route('produk.store') }}" method="POST">
@include('users._form')
</form>
@endsection