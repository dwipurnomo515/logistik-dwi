<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Logistik App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 col-lg-3 d-md-block offcanvas-md offcanvas-start bg-white vh-100 p-4 border-end" id="sidebar" tabindex="-1">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="fw-bold text-dark mb-0">Gudang Logistik</h4>
          <button type="button" class="btn-close d-md-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebar"></button>
        </div>
        <ul class="nav flex-column">
          <li class="nav-item mb-2">
            <a href="{{ route('barang.index') }}" class="nav-link d-flex align-items-center gap-2 py-2 px-3 rounded text-dark fw-medium active bg-light text-primary">
              <i class="bi bi-box-seam"></i> Stok Barang
            </a>
          </li>
          <li class="nav-item mb-2">
            <a href="{{ route('barang-masuk.index') }}" class="nav-link d-flex align-items-center gap-2 py-2 px-3 rounded text-dark fw-medium">
              <i class="bi bi-box-arrow-in-down"></i> Barang Masuk
            </a>
          </li>
          <li class="nav-item mb-2">
            <a href="{{ route('barang-keluar.index') }}" class="nav-link d-flex align-items-center gap-2 py-2 px-3 rounded text-dark fw-medium">
              <i class="bi bi-box-arrow-up"></i> Barang Keluar
            </a>
          </li>
        </ul>
      </div>

      <main class="col-md-8 col-lg-9 p-4">
        <div class="d-md-none mb-4">
          <button class="btn btn-outline-dark rounded-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
            <i class="bi bi-list fs-5"></i>
          </button>
        </div>

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>