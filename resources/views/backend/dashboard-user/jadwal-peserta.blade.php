@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
    <style>
        :root {
            --primary-color: #3498db;
            --success-color: #2ecc71;
            --light-bg: #f8f9fa;
            --card-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            --header-bg: linear-gradient(135deg, #3498db, #2c3e50);
        }
        
        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: var(--header-bg);
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
        }
        
        .section-title {
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            padding: 1rem;
            font-weight: 600;
        }
        
        .card-header.bg-info {
            background: linear-gradient(135deg, #3498db, #2980b9) !important;
            color: white !important;
        }
        
        .card-header.bg-success {
            background: linear-gradient(135deg, #2ecc71, #27ae60) !important;
            color: white !important;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        
        .table-light {
            background-color: #f8f9fa;
        }
        
        .btn-outline-info {
            color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-outline-info:hover {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .alert-success {
            background-color: rgba(46, 204, 113, 0.1);
            color: #27ae60;
        }
        
        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            color: #c0392b;
        }
        
        .empty-state {
            padding: 2rem;
            text-align: center;
            color: #7f8c8d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }
        .empty-state {
        text-align: center;
        color: #6c757d;
        padding: 20px;
    }
    
    .empty-state i {
        font-size: 2rem;
        margin-bottom: 10px;
    }
    
    .action-buttons .btn {
        transition: all 0.3s ease;
    }
    
    .action-buttons .btn:hover {
        transform: translateY(-2px);
    }
    
    .modal-header {
        border-bottom: none;
    }
    
    .modal-footer {
        border-top: none;
    }
    </style>
  </head>
  <body>
    <div class="page">
      <!-- Section Sidebar -->
      @include('backend.sidebar')
      
      <!-- Konten Utama -->
      <div class="page-wrapper">
        <div class="container-xl py-4">
            
            <!-- Menampilkan alert jika ada status -->
            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <!-- Page Header -->
            <div class="page-header d-print-none mb-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="section-title">
                            <i class="fas fa-chart-line me-2"></i> Daftar Nilai TOEFL
                        </h2>
                    </div>
                    <div class="col-auto">
                        <a href="/jadwal-user/pendaftaran" class="btn btn-outline-info">
                            <i class="fas fa-plus-circle me-2"></i> Daftar TOEFL
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Daftar Nilai -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col d-flex align-items-center">
                            <i class="fas fa-trophy me-2"></i>
                            <h5 class="mb-0">Daftar Nilai</h5>
                        </div>
                        <div class="action-buttons col-auto">
                            <button class="btn btn-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#printScoreModal">
                                <i class="fas fa-print me-1"></i> Cetak Nilai
                            </button>
                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#printCertificateModal">
                                <i class="fas fa-certificate me-1"></i> Cetak Sertifikat
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-hover table-striped text-center mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" rowspan="2" class="align-middle">No</th>
                                <th scope="col" rowspan="2" class="align-middle">Tanggal Test</th>
                                <th scope="col" colspan="4" class="align-middle">Nilai TOEFL</th>
                            </tr>
                            <tr>
                                <th scope="col">LIST</th>
                                <th scope="col">STR</th>
                                <th scope="col">RDG</th>
                                <th scope="col">SCORE</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                         <td colspan="6" class="py-4">
                            <div class="empty-state">
                                <i class="fas fa-chart-bar"></i>
                                <p class="mb-0">Belum ada data nilai yang tersedia.</p>
                            </div>
                         </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Cetak Nilai -->
            <div class="modal fade" id="printScoreModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title">
                                <i class="fas fa-print me-2"></i>
                                Cetak Nilai
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('print.score') }}" method="POST" target="_blank">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Periode Test</label>
                                    <select id="testDateSelect" class="form-select" name="test_date" required>
                                        <option value="">Pilih tanggal test...</option>
                                        <!-- Add your date options here -->
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Format Dokumen</label>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="format" value="pdf" checked>
                                            <label class="form-check-label">PDF</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="format" value="excel">
                                            <label class="form-check-label">Excel</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-info text-white">
                                    <i class="fas fa-print me-1"></i> Cetak
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Cetak Sertifikat -->
            <div class="modal fade" id="printCertificateModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title">
                                <i class="fas fa-certificate me-2"></i>
                                Cetak Sertifikat
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('print.certificate') }}" method="POST" target="_blank">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Periode Test</label>
                                    <select id="testDateSelect" class="form-select" name="test_date" required>
                                        <option value="">Pilih tanggal test...</option>
                                        <!-- Add your date options here -->
                                    </select>
                                </div>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Sertifikat hanya dapat dicetak jika nilai total TOEFL Anda minimal 450.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-info text-white">
                                    <i class="fas fa-certificate me-1"></i> Cetak Sertifikat
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Daftar Peserta -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users me-2"></i>
                        <h5 class="mb-0">Daftar Peserta</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-hover table-striped text-center mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="align-middle">No</th>
                                <th scope="col" class="align-middle">Nama Peserta</th>
                                <th scope="col" class="align-middle">Tanggal Test</th>
                                <th scope="col" class="align-middle">Status Pendaftaran</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($daftars as $key => $pendaftar)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $pendaftar->user->name }}</td>
                                <td>
                                    @if($pendaftar->jadwal->tanggal_test)
                                        <span class="badge bg-info text-white">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ \Carbon\Carbon::parse($pendaftar->jadwal->tanggal_test)->format('d M Y') }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">Tanggal tidak tersedia</span>
                                    @endif
                                </td>
                                <td>
                                    @if($pendaftar->status_pendaftaran == 'Terdaftar')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i> Terdaftar
                                        </span>
                                    @elseif($pendaftar->status_pendaftaran == 'Menunggu Konfirmasi')
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-clock me-1"></i> Menunggu Konfirmasi
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">{{ $pendaftar->status_pendaftaran }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4">
                                    <div class="empty-state">
                                        <i class="fas fa-calendar-xmark"></i>
                                        <p class="mb-0">Jadwal belum tersedia atau Anda belum terdaftar.</p>
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

    <!-- Libs JS -->
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '/get-test-dates',
                type: 'GET',
                success: function (data) {
                    let select = $('#testDateSelect');
                    data.forEach(function (date) {
                        select.append('<option value="' + date.tanggal_test + '">' + date.tanggal_test + '</option>');
                    });
                }
            });
        });
    </script>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection