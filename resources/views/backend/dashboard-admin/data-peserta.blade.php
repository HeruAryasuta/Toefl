<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Data Peserta - Admin Dashboard</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/css-dashboard/tabler.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-flags.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-payments.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-vendors.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/demo.min.css?1692870487') }}" rel="stylesheet"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"/>
    <style>
      :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --light-color: #f8f9fa;
        --dark-color: #212529;
        --success-color: #4caf50;
        --info-color: #2196f3;
        --warning-color: #ff9800;
        --danger-color: #f44336;
      }
      
      body {
        background-color: #f5f7fb;
        font-family: 'Inter', sans-serif;
      }
      
      .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        overflow: hidden;
      }
      
      .card-header {
        background: linear-gradient(135deg, #f5f7fb 0%, #e4e7ed 100%);
        border-bottom: 1px solid rgba(0,0,0,0.05);
      }
      
      .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
      }
      
      .btn-primary:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
      }
      
      .btn-warning {
        background-color: var(--warning-color);
        border-color: var(--warning-color);
      }
      
      .btn-danger {
        background-color: var(--danger-color);
        border-color: var(--danger-color);
      }
      
      .table thead th {
        background-color: rgba(67, 97, 238, 0.05);
        font-weight: 600;
        color: var(--dark-color);
      }
      
      .badge-role {
        border-radius: 20px;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 500;
      }
      
      .import-section {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
      }
      
      .file-upload-wrapper {
        position: relative;
        width: 100%;
      }
      
      .dataTables_wrapper .dataTables_length,
      .dataTables_wrapper .dataTables_filter {
        margin-bottom: 15px;
      }
      
      .dataTables_wrapper .dataTables_info,
      .dataTables_wrapper .dataTables_paginate {
        margin-top: 15px;
      }
      
      .modal-content {
        border-radius: 12px;
        border: none;
      }
      
      .modal-header {
        background-color: rgba(67, 97, 238, 0.05);
      }
      
      @media (max-width: 768px) {
        .card-header {
          flex-direction: column;
          align-items: flex-start;
        }
        
        .card-header .btn {
          margin-top: 10px;
        }
      }
    </style>
  </head>
  <body>
    <div class="page">
      <!-- Sidebar Section -->
      @include('backend.sidebar')
      <!-- Main Content -->
      <div class="page-wrapper">
        <div class="container-xl py-4">
          <!-- Header -->
          <div class="page-header d-print-none mb-4">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">Daftar Peserta</h2>
                <div class="text-muted mt-1">
                  <i class="far fa-calendar-alt me-1"></i> {{ now()->format('l, d F Y') }}
                </div>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-user-plus me-2"></i>
                    Tambah Peserta
                  </a>
                  <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-user-plus"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Notifikasi -->
          @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <div class="d-flex">
                <div><i class="fas fa-check-circle me-2"></i></div>
                <div>{{ session('status') }}</div>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <div class="d-flex">
                <div><i class="fas fa-exclamation-circle me-2"></i></div>
                <div>{{ session('error') }}</div>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @elseif ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <div class="d-flex">
                <div><i class="fas fa-exclamation-circle me-2"></i></div>
                <div>
                  <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <!-- Import Section -->
          <div class="import-section mb-4">
            <h3 class="mb-3">Import Data Peserta</h3>
            <form action="{{ url('data-peserta/import') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row g-3 align-items-center">
                <div class="col-md-8">
                  <div class="file-upload-wrapper">
                    <input type="file" name="import_file" class="form-control" required />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-file-import me-2"></i> Import Data
                    </button>
                  </div>
                </div>
              </div>
              <div class="mt-2 text-muted small">
                <i class="fas fa-info-circle me-1"></i> Format file yang didukung: .xlsx, .xls, .csv
              </div>
            </form>
          </div>

          <!-- Konten Utama -->
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">
                <i class="fas fa-users me-2 text-primary"></i>
                Data Peserta
              </h3>
              <div>
                <a href="#" class="btn btn-outline-secondary btn-sm">
                  <i class="fas fa-file-export me-1"></i> Export
                </a>
                <a href="#" class="btn btn-outline-primary btn-sm ms-2">
                  <i class="fas fa-sync-alt me-1"></i> Refresh
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="peserta-table" class="table table-vcenter table-hover">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 40px;">No</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>NIM</th>
                      <th>Fakultas</th>
                      <th>Prodi</th>
                      <th>No HP</th>
                      <th>Role</th>
                      <th class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $user)
                      <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="font-weight-medium">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nim }}</td>
                        <td>{{ $user->fakultas }}</td>
                        <td>{{ $user->prodi }}</td>
                        <td>{{ $user->no_hp }}</td>
                        <td>
                          @if($user->role == 'admin')
                            <span class="badge bg-primary badge-role">Admin</span>
                          @elseif($user->role == 'user')
                            <span class="badge bg-success badge-role">User</span>
                          @else
                            <span class="badge bg-secondary badge-role">{{ ucfirst($user->role) }}</span>
                          @endif
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button class="btn btn-sm btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-{{ $user->id_users }}" title="Edit">
                              <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('data-peserta.destroy', $user->id_users) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?')" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </form>
                          </div>
                        </td>
                      </tr>
                      
                      <!-- Modal Edit -->
                      <div class="modal fade" id="editModal-{{ $user->id_users }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $user->id_users }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel-{{ $user->id_users }}">
                                <i class="fas fa-user-edit me-2 text-warning"></i>
                                Edit Data Peserta
                              </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('data-peserta.update', $user->id_users) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                  <label for="name" class="form-label">Nama</label>
                                  <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                </div>
                                <div class="mb-3">
                                  <label for="email" class="form-label">Email</label>
                                  <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                </div>
                                <div class="mb-3">
                                  <label for="nim" class="form-label">NIM</label>
                                  <input type="text" class="form-control" id="nim" name="nim" value="{{ $user->nim }}">
                                </div>
                                <div class="mb-3">
                                  <label for="fakultas" class="form-label">Fakultas</label>
                                  <input type="text" class="form-control" id="fakultas" name="fakultas" value="{{ $user->fakultas }}">
                                </div>
                                <div class="mb-3">
                                  <label for="prodi" class="form-label">Prodi</label>
                                  <input type="text" class="form-control" id="prodi" name="prodi" value="{{ $user->prodi }}">
                                </div>
                                <div class="mb-3">
                                  <label for="no_hp" class="form-label">No HP</label>
                                  <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $user->no_hp }}">
                                </div>
                                <div class="mb-3">
                                  <label for="role" class="form-label">Role</label>
                                  <select class="form-select" id="role" name="role" required>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="peserta" {{ $user->role == 'peserta' ? 'selected' : '' }}>Peserta</option>
                                  </select>
                                </div>
                                <div class="d-flex justify-content-end mt-4">
                                  <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    @empty
                      <tr>
                        <td colspan="9" class="text-center py-4">
                          <div class="empty">
                            <div class="empty-img">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="84" height="84" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <line x1="9" y1="10" x2="9.01" y2="10"></line>
                                <line x1="15" y1="10" x2="15.01" y2="10"></line>
                                <path d="M9.5 15.25a3.5 3.5 0 0 1 5 0"></path>
                              </svg>
                            </div>
                            <p class="empty-title">Tidak ada data peserta</p>
                            <p class="empty-subtitle text-muted">
                              Silahkan tambahkan peserta baru atau import data peserta untuk memulai.
                            </p>
                            <div class="empty-action">
                              <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <i class="fas fa-user-plus me-2"></i> Tambah Peserta Baru
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Tambah Peserta -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addUserModalLabel">
              <i class="fas fa-user-plus me-2 text-primary"></i>
              Tambah Peserta Baru
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('data-peserta.store') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim">
              </div>
              <div class="mb-3">
                <label for="fakultas" class="form-label">Fakultas</label>
                <input type="text" class="form-control" id="fakultas" name="fakultas">
              </div>
              <div class="mb-3">
                <label for="prodi" class="form-label">Prodi</label>
                <input type="text" class="form-control" id="prodi" name="prodi">
              </div>
              <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp">
              </div>
              <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required>
                  <option value="admin">Admin</option>
                  <option value="peserta" selected>Peserta</option>
                </select>
              </div>
              <div class="d-flex justify-content-end mt-4">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
      $(document).ready(function() {
        $('#peserta-table').DataTable({
          language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ entri",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
            infoFiltered: "(disaring dari _MAX_ total entri)",
            zeroRecords: "Tidak ada data yang cocok",
            paginate: {
              first: "Pertama",
              last: "Terakhir",
              next: "Selanjutnya",
              previous: "Sebelumnya"
            }
          }
        });
      });
    </script>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </body>
</html>