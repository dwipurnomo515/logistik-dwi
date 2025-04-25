@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Detail Barang: {{ $barang->nama_barang }}</h2>

    <div class="card mt-4">
        <div class="card-body">
            <p><strong>Kode Barang:</strong> {{ $barang->kode_barang }}</p>
            <p><strong>Nama Barang:</strong> {{ $barang->nama_barang }}</p>
            <p><strong>Stok Saat Ini:</strong> {{ $barang->stok }}</p>
        </div>
    </div>
    <a href="{{ route('stok.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection