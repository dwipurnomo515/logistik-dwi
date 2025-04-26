@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h2 class="fw-bold">Daftar Stok Barang</h2>
  <a href="{{ route('barang.create') }}" class="btn btn-dark">
    <strong>+</strong> Tambah Barang
  </a>
</div>

<div class="mb-4">
  <form action="{{ route('barang.index') }}" method="GET">
    <div class="row justify-content-end">
      <div class="col-md-4">
        <div class="input-group">
          <input type="text" 
                 name="search" 
                 class="form-control" 
                 placeholder="Cari barang..." 
                 value="{{ request('search') }}">
          <button type="submit" class="btn btn-outline-secondary">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="card">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>
              <a href="{{ route('barang.index', array_merge(request()->all(), ['sort' => 'kode_barang', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="text-decoration-none text-dark">
                Kode Barang
                @if(request('sort') == 'kode_barang')
                  <i class="bi bi-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                @endif
              </a>
            </th>
            <th>
              <a href="{{ route('barang.index', array_merge(request()->all(), ['sort' => 'nama_barang', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="text-decoration-none text-dark">
                Nama Barang
                @if(request('sort') == 'nama_barang')
                  <i class="bi bi-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                @endif
              </a>
            </th>
            <th>Kategori</th>
            <th>
              <a href="{{ route('barang.index', array_merge(request()->all(), ['sort' => 'stok', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="text-decoration-none text-dark">
                Stok
                @if(request('sort') == 'stok')
                  <i class="bi bi-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                @endif
              </a>
            </th>
            <th>Lokasi Gudang</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($barangs as $barang)
          <tr>
            <td>{{ $barang->kode_barang }}</td>
            <td>{{ $barang->nama_barang }}</td>
            <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
            <td>{{ $barang->stok }}</td>
            <td>{{ $barang->lokasi_gudang ?? '-' }}</td>
            <td>
              <div class="btn-group">
                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus barang ini?')">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center py-4">
              <i class="bi bi-search display-6 text-secondary"></i>
              <p class="mt-2 mb-0">Tidak ada data ditemukan</p>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      {{ $barangs->withQueryString()->links() }}
    </div>
  </div>
</div>
@endsection
