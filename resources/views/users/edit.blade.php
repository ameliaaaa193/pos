@extends('layouts.app')

@section('title', 'Edit user')

@section('content')
<h4>Edit user</h4>

<form action="{{ route('produk.update', $user) }}" method="post">
    @include('users._form')
</form>
@endsection