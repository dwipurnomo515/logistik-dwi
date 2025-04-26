@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h2 class="fw-bold">Daftar Barang Keluar</h2>
  <a href="{{ route('barang-keluar.create') }}" class="btn btn-dark">
    <strong>+</strong> Tambah Barang Keluar
  </a>
</div>

<div class="mb-4">
  <form action="{{ route('barang-keluar.index') }}" method="GET" id="searchForm">
    <div class="row g-3">
      <div class="col-md-4">
        <div class="input-group">
          <input type="text" 
                 name="search" 
                 class="form-control" 
                 placeholder="Cari kode/nama barang..." 
                 value="{{ request('search') }}"
                 id="searchInput">
          <button type="submit" class="btn btn-outline-secondary">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </div>

      <div class="col-md-4">
        <div class="input-group">
          <input type="date" 
                 name="start_date" 
                 class="form-control" 
                 value="{{ request('start_date') }}"
                 onchange="this.form.submit()">
          <span class="input-group-text">s/d</span>
          <input type="date" 
                 name="end_date" 
                 class="form-control" 
                 value="{{ request('end_date') }}"
                 onchange="this.form.submit()">
        </div>
      </div>

      <div class="col-md-2">
        <a href="{{ route('barang-keluar.index') }}" class="btn btn-outline-secondary w-100">
          <i class="bi bi-arrow-counterclockwise"></i> Reset
        </a>
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
              <a href="{{ route('barang-keluar.index', array_merge(request()->all(), ['sort' => 'kode_barang', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="text-decoration-none text-dark">
                Kode Barang
                @if(request('sort') == 'kode_barang')
                  <i class="bi bi-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                @endif
              </a>
            </th>
            <th>
              <a href="{{ route('barang-keluar.index', array_merge(request()->all(), ['sort' => 'nama_barang', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="text-decoration-none text-dark">
                Nama Barang
                @if(request('sort') == 'nama_barang')
                  <i class="bi bi-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                @endif
              </a>
            </th>
            <th>
              <a href="{{ route('barang-keluar.index', array_merge(request()->all(), ['sort' => 'quantity', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="text-decoration-none text-dark">
                Quantity
                @if(request('sort') == 'quantity')
                  <i class="bi bi-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                @endif
              </a>
            </th>
            <th>Destination</th>
            <th>
              <a href="{{ route('barang-keluar.index', array_merge(request()->all(), ['sort' => 'tanggal_keluar', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="text-decoration-none text-dark">
                Tanggal Keluar
                @if(request('sort') == 'tanggal_keluar')
                  <i class="bi bi-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                @endif
              </a>
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse($barangKeluar as $item)
          <tr>
            <td>{{ $item->barang->kode_barang }}</td>
            <td>{{ $item->barang->nama_barang }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->destination }}</td>
            <td>{{ $item->tanggal_keluar }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center py-4">
              <i class="bi bi-search display-6 text-secondary"></i>
              <p class="mt-2 mb-0">Tidak ada data ditemukan</p>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      {{ $barangKeluar->withQueryString()->links() }}
    </div>
  </div>
</div>

@push('scripts')
<script>
let debounceTimer;
const searchInput = document.getElementById('searchInput');
const searchForm = document.getElementById('searchForm');

searchInput.addEventListener('input', function() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        searchForm.submit();
    }, 500); 
});
</script>
@endpush
@endsection