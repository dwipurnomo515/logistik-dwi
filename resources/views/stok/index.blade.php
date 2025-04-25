@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Daftar Stok Barang</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                    <tr>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td><a href="{{ route('stok.show', $barang->id) }}" class="btn btn-info btn-sm">Lihat</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection