@extends('layouts.app')

@section('content')
<h2 class="mb-4 fw-bold">Edit Barang</h2>

<div class="card">
  <div class="card-body p-4">
    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
      @csrf
      @method('PUT')
      
      <div class="row mb-4">
        <div class="col-md-6">
          <label for="kode_barang" class="form-label fw-semibold">Kode Barang</label>
          <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ $barang->kode_barang }}" readonly>
        </div>
        
        <div class="col-md-6">
          <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
          <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
          @error('nama_barang')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      
      <div class="row mb-4">
        <div class="col-md-6">
          <label for="kategori_id" class="form-label fw-semibold">Kategori</label>
          <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id">
            <option value="">Pilih Kategori</option>
            @foreach($kategoris as $kategori)
              <option value="{{ $kategori->id }}" {{ old('kategori_id', $barang->kategori_id) == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
              </option>
            @endforeach
          </select>
          @error('kategori_id')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="col-md-6">
          <label for="stok" class="form-label fw-semibold">Stok</label>
          <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok', $barang->stok) }}" required min="0">
          @error('stok')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      
      <div class="row mb-4">
        <div class="col-md-6">
          <label for="lokasi_gudang" class="form-label fw-semibold">Lokasi Gudang</label>
          <input type="text" class="form-control @error('lokasi_gudang') is-invalid @enderror" id="lokasi_gudang" name="lokasi_gudang" value="{{ old('lokasi_gudang', $barang->lokasi_gudang) }}">
          @error('lokasi_gudang')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="col-md-6">
          <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
          <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
          @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      
      <div class="d-flex justify-content-between">
        <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">Kembali</a>
        <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
@endsection 