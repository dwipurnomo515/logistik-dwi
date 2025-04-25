@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h2 class="fw-bold">Daftar Barang Masuk</h2>
  <a href="{{ route('barang-masuk.create') }}" class="btn btn-dark">
    <strong>+</strong> Tambah Barang Masuk
  </a>
</div>

<div class="card">
  <div class="card-body p-0">
    <table class="table table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Quantity</th>
          <th>Origin</th>
          <th>Tanggal Masuk</th>
        </tr>
      </thead>
      <tbody>
        @foreach($barangMasuk as $item)
        <tr>
          <td>{{ $item->barang->kode_barang }}</td>
          <td>{{ $item->barang->nama_barang }}</td>
          <td>{{ $item->quantity }}</td>
          <td>{{ $item->origin }}</td>
          <td>{{ $item->tanggal_masuk }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection