@extends('layouts.app')

@section('content')
<h2 class="mb-4 fw-bold">Tambah Barang</h2>

<div class="card">
  <div class="card-body p-4">
    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="row mb-4">
        <div class="col-md-6">
          <label for="kode" class="form-label fw-semibold">
            <i class="bi bi-code-slash me-1"></i> Kode Barang
          </label>
          <input type="text" name="kode_barang" id="kode" class="form-control" placeholder="Masukkan kode barang" required>
        </div>

        <div class="col-md-6">
          <label for="nama" class="form-label fw-semibold">
            <i class="bi bi-file-earmark-text me-1"></i> Nama Barang
          </label>
          <input type="text" name="nama_barang" id="nama" class="form-control" placeholder="Masukkan nama barang" required>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-6">
          <label for="stok" class="form-label fw-semibold">
            <i class="bi bi-box me-1"></i> Stok
          </label>
          <input type="number" name="stok" id="stok" class="form-control" value="0" required>
        </div>

        <div class="col-md-6">
          <label for="kategori" class="form-label fw-semibold">
            <i class="bi bi-tags me-1"></i> Kategori
          </label>
          <select name="kategori_id" id="kategori" class="form-select" required>
            <option value="" disabled selected>Pilih kategori</option>
            @foreach ($kategoris as $item)
              <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
            @endforeach
          </select>
        </div>
        
      </div>

      <div class="row mb-4">
        <div class="col-md-6">
          <label for="lokasi_gudang" class="form-label fw-semibold">
            <i class="bi bi-geo-alt me-1"></i> Lokasi Gudang
          </label>
          <input type="text" name="lokasi_gudang" id="lokasi_gudang" class="form-control" placeholder="Contoh: Gudang A, Rak 2">
        </div>

        <div class="col-md-6">
          <label for="foto" class="form-label fw-semibold">
            <i class="bi bi-image me-1"></i> Foto Barang
          </label>
          <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
        </div>
      </div>

      <div class="mb-4">
        <label for="deskripsi" class="form-label fw-semibold">
          <i class="bi bi-card-text me-1"></i> Deskripsi
        </label>
        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi barang"></textarea>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-dark py-2">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
