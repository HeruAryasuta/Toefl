@extends('layouts.app')

@section("title", "Penjadwalan")

@section('content')
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-hover: #2563eb;
            --danger-color: #ef4444;
            --danger-hover: #dc2626;
            --warning-color: #f59e0b;
            --warning-hover: #d97706;
            --success-color: #10b981;
            --success-hover: #059669;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        .page-title {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
        
        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .card-header.bg-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover)) !important;
        }
        
        .card-title {
            font-weight: 600;
            font-size: 1.05rem;
        }
        
        .btn-light {
            background-color: rgba(255,255,255,0.9);
            border: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.2s;
        }
        
        .btn-light:hover {
            background-color: #fff;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }
        
        .btn-sm {
            padding: 0.25rem 0.7rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
        }
        
        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
            color: white;
        }
        
        .btn-warning:hover {
            background-color: var(--warning-hover);
            border-color: var(--warning-hover);
            color: white;
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .btn-danger:hover {
            background-color: var(--danger-hover);
            border-color: var(--danger-hover);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        .table {
            --bs-table-striped-bg: rgba(0,0,0,0.02);
            margin-bottom: 0;
        }
        
        .table th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 0.75rem 1rem;
            vertical-align: middle;
        }
        
        .table td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
            color: #334155;
        }
        
        .table-bordered th,
        .table-bordered td {
            border-color: #e2e8f0;
        }
        
        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .alert-danger ul {
            margin-bottom: 0;
            padding-left: 1.25rem;
        }
        
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1);
        }
        
        .modal-header {
            border-bottom: 1px solid #e5e7eb;
            padding: 1.25rem 1.5rem;
        }
        
        .modal-title {
            font-weight: 600;
            color: #1e293b;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-footer {
            border-top: 1px solid #e5e7eb;
            padding: 1.25rem 1.5rem;
        }
        
        .form-label {
            font-weight: 500;
            color: #475569;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            padding: 0.5rem 0.75rem;
            transition: border-color 0.2s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        
        /* Badge for kuota */
        .badge-kuota {
            background-color: #e0f2fe;
            color: #0369a1;
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 6px;
        }
        
        /* Animation for alerts */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .alert {
            animation: fadeIn 0.3s ease-out;
        }
        
        /* Pagination styling */
        .pagination {
            margin-top: 1.5rem;
            justify-content: center;
        }
        
        .page-link {
            color: var(--primary-color);
            border-radius: 6px;
            margin: 0 0.2rem;
        }
        
        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .btn-sm {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
                display: block;
                margin-bottom: 0.5rem;
                width: 100%;
            }
            
            form.d-inline {
                display: block !important;
            }
            
            .card-header {
                flex-direction: column;
                gap: 1rem;
            }
            
            .btn-action-group {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
    <div class="page">
        <!-- Sidebar -->
        @include('backend.sidebar')

        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-xl py-4">
                <div class="page-header d-print-none mb-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="page-title">Daftar Penjadwalan</h2>
                            <div class="text-muted mt-1">Kelola jadwal test untuk pendaftar</div>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <button class="btn btn-primary d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#tambahModal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Tambah Jadwal Baru
                            </button>
                        </div>
                    </div>
                </div>
                
                @if (session('status'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <div>{{ session('status') }}</div>
                    </div>
                @endif
                
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                        Tabel Jadwal
                        </h3>
                        <div class="input-group input-group-sm w-auto">
                            <input type="text" class="form-control" placeholder="Cari jadwal...">
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger d-flex" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2 mt-1"></i>
                                <div>
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mt-1 mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        
                        <div class="table-responsive">
                            <table class="table table-vcenter table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 60px">No</th>
                                        <th>Tanggal Test</th>
                                        <th>Jam Test</th>
                                        <th>Lokasi</th>
                                        <th class="text-center" style="width: 100px">Kuota</th>
                                        <th class="text-center" style="width: 150px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwalTests as $jadwal)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-calendar-event me-2 text-primary"></i>
                                                    <span>{{ \Carbon\Carbon::parse($jadwal->tanggal_test)->translatedFormat('j F Y') }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-clock me-2 text-primary"></i>
                                                    <span>{{ \Carbon\Carbon::parse($jadwal->jam_test)->format('H:i') }} WIB</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-geo-alt me-2 text-primary"></i>
                                                    <span>{{ $jadwal->lokasi }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-kuota">
                                                    <i class="bi bi-people me-1"></i>
                                                    {{ $jadwal->kuota }} orang
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-action-group" role="group">
                                                    <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editModal-{{ $jadwal->id_jadwal }}">
                                                        <i class="bi bi-pencil-fill me-1"></i>Edit
                                                    </button>
                                                    <form action="{{ route('jadwal.destroy', $jadwal->id_jadwal) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                            <i class="bi bi-trash-fill me-1"></i>Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- Modal Edit for each jadwal -->
                                        <div class="modal fade" id="editModal-{{ $jadwal->id_jadwal }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $jadwal->id_jadwal }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <form action="{{ route('jadwal.update', $jadwal->id_jadwal) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel-{{ $jadwal->id_jadwal }}">
                                                                <i class="bi bi-pencil-square me-2 text-warning"></i>Edit Jadwal
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="tanggal-{{ $jadwal->id_jadwal }}" class="form-label">Tanggal</label>
                                                                <input type="date" class="form-control" id="tanggal-{{ $jadwal->id_jadwal }}" name="tanggal" value="{{ \Carbon\Carbon::parse($jadwal->tanggal_test)->format('Y-m-d') }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jam_test-{{ $jadwal->id_jadwal }}" class="form-label">Jam Test</label>
                                                                <input type="time" class="form-control" id="jam_test-{{ $jadwal->id_jadwal }}" name="jam_test" value="{{ \Carbon\Carbon::parse($jadwal->jam_test)->format('H:i') }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="lokasi-{{ $jadwal->id_jadwal }}" class="form-label">Lokasi</label>
                                                                <input type="text" class="form-control" id="lokasi-{{ $jadwal->id_jadwal }}" name="lokasi" value="{{ $jadwal->lokasi }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="kuota-{{ $jadwal->id_jadwal }}" class="form-label">Kuota</label>
                                                                <input type="number" class="form-control" id="kuota-{{ $jadwal->id_jadwal }}" name="kuota" value="{{ $jadwal->kuota }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="bi bi-save me-1"></i>Simpan Perubahan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        @if(count($jadwalTests) == 0)
                            <div class="empty py-4 text-center">
                                <div class="empty-img">
                                    <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                                </div>
                                <p class="empty-title mt-2">Belum ada jadwal test</p>
                                <p class="empty-subtitle text-muted">
                                    Silahkan tambahkan jadwal test baru dengan mengklik tombol "Tambah Jadwal Baru"
                                </p>
                            </div>
                        @endif
                        
                        <!-- Pagination - if you have it -->
                        <div class="mt-3">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                            <i class="bi bi-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">
                            <i class="bi bi-calendar-plus me-2 text-primary"></i>Tambah Jadwal Baru
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Test</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            <div class="form-text text-muted">
                                <i class="bi bi-info-circle-fill me-1"></i>Pilih tanggal pelaksanaan test
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="jam_test" class="form-label">Jam Test</label>
                            <input type="time" class="form-control" id="jam_test" name="jam_test" required>
                            <div class="form-text text-muted">
                                <i class="bi bi-info-circle-fill me-1"></i>Format 24 jam (contoh: 14:00)
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukkan lokasi test" required>
                        </div>
                        <div class="mb-3">
                            <label for="kuota" class="form-label">Kuota</label>
                            <input type="number" class="form-control" id="kuota" name="kuota" placeholder="Jumlah peserta maksimal" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>Simpan Jadwal
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
@endsection