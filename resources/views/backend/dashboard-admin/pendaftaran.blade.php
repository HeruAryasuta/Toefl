<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Admin Dashboard</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/css-dashboard/tabler.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-flags.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-payments.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-vendors.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/demo.min.css?1692870487') }}" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      body {
        font-family: 'Inter', sans-serif;
        background-color: #f5f7fb;
      }
      .page-title {
        font-weight: 600;
        color: #1e293b;
      }
      .card {
        border-radius: 10px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
      }
      .card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 1rem 1.5rem;
      }
      .card-title {
        font-weight: 600;
        margin-bottom: 0;
        color: #334155;
      }
      .table {
        --bs-table-striped-bg: rgba(0, 0, 0, 0.02);
      }
      .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.025em;
        color: #64748b;
        background-color: #f8fafc;
        white-space: nowrap;
      }
      .table td {
        vertical-align: middle;
        padding: 0.75rem 1rem;
        color: #334155;
      }
      .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        border-radius: 4px;
      }
      .badge-waiting {
        background-color: #ffe4a3;
        color: #854d0e;
      }
      .badge-accepted {
        background-color: #bbf7d0;
        color: #166534;
      }
      .badge-rejected {
        background-color: #fecaca;
        color: #991b1b;
      }
      .btn-verify {
        padding: 0.375rem 1rem;
        font-size: 0.875rem;
        border-radius: 6px;
        transition: all 0.2s;
        background-color: #0ea5e9;
        border-color: #0ea5e9;
      }
      .btn-verify:hover {
        background-color: #0284c7;
        border-color: #0284c7;
      }
      .alert-success {
        background-color: #ecfdf5;
        border-color: #d1fae5;
        color: #065f46;
        border-radius: 8px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
      }
      .alert-danger {
        background-color: #fef2f2;
        border-color: #fee2e2;
        color: #991b1b;
        border-radius: 8px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
      }
      .modal-content {
        border-radius: 10px;
        border: none;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      }
      .modal-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.25rem 1.5rem;
      }
      .modal-title {
        font-weight: 600;
        color: #1e293b;
      }
      .modal-body {
        padding: 1.5rem;
      }
      .form-label {
        font-weight: 500;
        color: #475569;
        margin-bottom: 0.5rem;
      }
      .form-select {
        border-radius: 6px;
        border-color: #e2e8f0;
        padding: 0.5rem 0.75rem;
      }
      .form-select:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25);
      }
      .btn-primary {
        background-color: #0ea5e9;
        border-color: #0ea5e9;
        border-radius: 6px;
        font-weight: 500;
        padding: 0.5rem 1.25rem;
      }
      .btn-primary:hover {
        background-color: #0284c7;
        border-color: #0284c7;
      }
      .page-wrapper {
        padding: 1.5rem;
      }
      .container-xl {
        max-width: 1320px;
      }
      
      /* Responsive adjustments */
      @media (max-width: 992px) {
        .page-wrapper {
          padding: 1rem;
        }
        .card {
          margin-bottom: 1rem;
        }
      }
      
      /* Custom scrollbar */
      ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
      }
      ::-webkit-scrollbar-track {
        background: #f1f5f9;
      }
      ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
      }
      ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
      }
    </style>
  </head>
  <body>
    <div class="page">
      <!-- Sidebar -->
      @include('backend.sidebar')
      <!-- Main Content -->
      <div class="page-wrapper">
        <div class="container-xl">
          @if (session('success'))
          <div class="alert alert-success" role="alert">
            <div class="d-flex align-items-center">
              <i class="fas fa-check-circle me-2"></i>
              <div>{{ session('success') }}</div>
            </div>
          </div>
          @endif
          <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">Daftar Pendaftar</h2>
                <div class="text-muted mt-1">Kelola dan verifikasi data pendaftar</div>
              </div>
              <div class="col-auto ms-auto">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    <a href="#" class="btn btn-white">
                      <i class="fas fa-file-export me-2"></i>Export
                    </a>
                  </span>
                  <a href="#" class="btn btn-primary d-none d-sm-inline-block">
                    <i class="fas fa-plus me-2"></i>Tambah Pendaftar
                  </a>
                  <a href="#" class="btn btn-primary d-sm-none btn-icon">
                    <i class="fas fa-plus"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="card-title">Tabel Pendaftar</h3>
                </div>
                <div class="col-auto">
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Cari pendaftar...">
                    <button class="btn btn-white" type="button">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              @if ($errors->any())
              <div class="alert alert-danger" role="alert">
                <div class="d-flex">
                  <i class="fas fa-exclamation-circle me-2 mt-1"></i>
                  <div>
                    <div class="fw-bold">Terjadi kesalahan:</div>
                    <ul class="list-unstyled mt-1 mb-0">
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              @endif
              <div class="table-responsive">
                <table class="table table-vcenter table-hover table-striped">
                  <thead>
                    <tr>
                      <th class="w-1">No</th>
                      <th>Nama Pengguna</th>
                      <th>Jadwal Ujian</th>
                      <th>Status Pendaftaran</th>
                      <th class="w-1">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pendaftaran as $daftar)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td class="fw-medium">{{ $daftar['user']['name'] ?? 'Nama tidak tersedia' }}</td>
                      <td>
                        @if (isset($daftar['jadwal']['tanggal']))
                          <span class="text-muted"><i class="far fa-calendar me-1"></i>{{ $daftar['jadwal_test']['tanggal_test'] }}</span>
                        @else
                          <span class="text-muted">Tanggal tidak tersedia</span>
                        @endif
                      </td>
                      <td>
                        @if($daftar['status_pendaftaran'] == 'Menunggu')
                          <span class="badge badge-waiting">Menunggu</span>
                        @elseif($daftar['status_pendaftaran'] == 'Diterima')
                          <span class="badge badge-accepted">Diterima</span>
                        @elseif($daftar['status_pendaftaran'] == 'Ditolak')
                          <span class="badge badge-rejected">Ditolak</span>
                        @else
                          <span class="badge bg-secondary">{{ $daftar['status_pendaftaran'] }}</span>
                        @endif
                      </td>
                      <td>
                        <button type="button" class="btn btn-verify" data-bs-toggle="modal" data-bs-target="#verifikasiModal-{{ $daftar['id_pendaftaran'] }}">
                          <i class="fas fa-check-circle me-1"></i> Verifikasi
                        </button>
                      </td>
                    </tr>
                    <!-- Modal Verifikasi -->
                    <div class="modal fade" id="verifikasiModal-{{ $daftar['id_pendaftaran'] }}" tabindex="-1" aria-labelledby="verifikasiModalLabel-{{ $daftar['id_pendaftaran'] }}" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="verifikasiModalLabel-{{ $daftar['id_pendaftaran'] }}">
                              <i class="fas fa-user-check me-2 text-primary"></i>Verifikasi Pendaftaran
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p class="text-muted mb-3">Silahkan pilih status verifikasi untuk pendaftar <strong>{{ $daftar['user']['name'] ?? 'Nama tidak tersedia' }}</strong></p>
                            <form action="{{ route('pendaftaran.verifikasi', $daftar['id_pendaftaran']) }}" method="POST">
                              @csrf
                              <div class="mb-3">
                                <label for="status_pendaftaran-{{ $daftar['id_pendaftaran'] }}" class="form-label">Status Verifikasi</label>
                                <select class="form-select" id="status_pendaftaran-{{ $daftar['id_pendaftaran'] }}" name="status_pendaftaran" required>
                                  <option value="" selected disabled>Pilih status verifikasi</option>
                                  <option value="Diterima">Diterima</option>
                                  <option value="Ditolak">Ditolak</option>
                                </select>
                              </div>
                              <div class="d-flex justify-content-end gap-2 mt-4">
                                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">
                                  <i class="fas fa-save me-1"></i> Simpan
                                </button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="mt-3 d-flex justify-content-between align-items-center">
                <div class="text-muted">
                  Menampilkan <strong>{{ count($pendaftaran) }}</strong> dari <strong>{{ count($pendaftaran) }}</strong> pendaftar
                </div>
                <div>
                  <ul class="pagination m-0">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                        <i class="fas fa-chevron-left"></i>
                      </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#">
                        <i class="fas fa-chevron-right"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
    <!-- JavaScript -->
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>