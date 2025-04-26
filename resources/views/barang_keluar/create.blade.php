@extends('layouts.app')
@section('content')
<h2 class="mb-4 fw-bold">Pencatatan Barang Keluar</h2>

<div class="card">
  <div class="card-body p-4">
    <form action="{{ route('barang-keluar.store') }}" method="POST">
      @csrf
      
      <div class="row mb-4">
        <div class="col-md-6">
          <label for="barang_id" class="form-label fw-semibold">Nama Barang</label>
          <select name="barang_id" class="form-select" required>
            @foreach ($barang as $item)
              <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
            @endforeach
          </select>
        </div>
        
        <div class="col-md-6">
          <label class="form-label fw-semibold">Quantity</label>
          <input type="number" name="quantity" class="form-control" required placeholder="Masukkan Quantity">
        </div>
      </div>
      
      <div class="row mb-4">
        <div class="col-md-6">
          <label class="form-label fw-semibold">Destination (Tujuan Barang)</label>
          <input type="text" name="destination" class="form-control" required placeholder="Masukkan Tujuan Barang">
        </div>
        
        <div class="col-md-6">
          <label class="form-label fw-semibold">Tanggal Keluar</label>
          <input type="date" name="tanggal_keluar" class="form-control" required>
        </div>
      </div>
      
      <div class="d-grid">
        <button type="submit" class="btn btn-dark py-2">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection