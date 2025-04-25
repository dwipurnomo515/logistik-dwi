@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h2 class="fw-bold">Daftar Stok Barang</h2>
  <a href="{{ route('barang.create') }}" class="btn btn-dark">
    <strong>+</strong> Tambah Barang
  </a>
</div>

<div class="card">
  <div class="card-body p-0">
    <table class="table table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th>Foto</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Kategori</th>
          <th>Stok</th>
          <th>Lokasi Gudang</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($barangs as $barang)
        <tr>
          <td>
            @if ($barang->foto)
            <img src="{{ asset('storage/barang/' . $barang->foto) }}" alt="foto barang">
            @else
              <em>Belum ada</em>
            @endif
          </td>
          <td>{{ $barang->kode_barang }}</td>
          <td>{{ $barang->nama_barang }}</td>
          <td>{{ $barang->kategori ?? '-' }}</td>
          <td>{{ $barang->stok }}</td>
          <td>{{ $barang->lokasi_gudang ?? '-' }}</td>
          <td>
            <a href="{{ route('barang.show', $barang->id) }}" class="btn btn-sm btn-info">Detail</a>
          </td>
        </tr>
        @endforeach
      </tbody>
      
    </table>
  </div>
</div>
@endsection
