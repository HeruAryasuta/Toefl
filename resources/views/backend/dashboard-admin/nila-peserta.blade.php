@extends('layouts.app')

@section('title', 'Nilai Peserta')

@section('content')

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --success-light: #dcfce7;
            --success-dark: #15803d;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .score-card {
            transition: transform 0.2s ease-in-out;
        }

        .score-card:hover {
            transform: translateY(-2px);
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .score-input::-webkit-inner-spin-button,
        .score-input::-webkit-outer-spin-button {
            opacity: 1;
        }
    </style>
    <div class="page">
      <!-- Section Sidebar -->
      @include('backend.sidebar')
      <!-- Konten Utama -->
      <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page Header -->
            <div class="page-header d-print-none mb-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">Daftar Nilai TOEFL</h2>
                        <div class="text-muted mt-1">Manajemen nilai TOEFL peserta</div>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-input-nilai">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Input Nilai Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Success -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                    </div>
                    <div>{{ session('success') }}</div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
            @endif

            <!-- Main Card -->
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Tabel Nilai TOEFL</h3>
                    <div class="input-group input-group-sm w-auto">
                        <input type="text" class="form-control" placeholder="Cari Nama...">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-bordered">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Nama Peserta</th>
                                    <th>Tanggal Test</th>
                                    <th class="text-center">Listening</th>
                                    <th class="text-center">Structure</th>
                                    <th class="text-center">Reading</th>
                                    <th class="text-center">Total Score</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riwayatNilai as $index => $nilai)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $nilai->pendaftar->nama }}</td>
                                    <td>{{ $nilai->tanggal_test->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ number_format($nilai->listening, 1) }}</td>
                                    <td class="text-center">{{ number_format($nilai->structure, 1) }}</td>
                                    <td class="text-center">{{ number_format($nilai->reading, 1) }}</td>
                                    <td class="text-center fw-bold">{{ number_format($nilai->total_nilai, 1) }}</td>
                                    <td class="text-center">
                                        <div class="btn-list">
                                            <a href="#" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit-nilai-{{ $nilai->id_riwayat }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                    <path d="M16 5l3 3"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('nilai-peserta.destroy', $nilai->id_riwayat) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M4 7l16 0"></path>
                                                        <path d="M10 11l0 6"></path>
                                                        <path d="M14 11l0 6"></path>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Input Nilai -->
    <div class="modal modal-blur fade" id="modal-input-nilai" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Nilai TOEFL</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('nilai-peserta.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required">Peserta</label>
                            <select class="form-select" name="id_pendaftaran" required>
                                <option value="">Pilih Peserta</option>
                                @foreach($pendaftaran as $p)
                                <option value="{{ $p->id_pendaftaran }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Tanggal Test</label>
                            <input type="date" class="form-control" name="tanggal_test" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">Listening</label>
                                    <input type="number" class="form-control" name="listening" step="0.1" min="0" max="100" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">Structure</label>
                                    <input type="number" class="form-control" name="structure" step="0.1" min="0" max="100" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">Reading</label>
                                    <input type="number" class="form-control" name="reading" step="0.1" min="0" max="100" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Nilai -->
    @foreach($riwayatNilai as $nilai)
    <div class="modal modal-blur fade" id="modal-edit-nilai-{{ $nilai->id_riwayat }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Nilai TOEFL</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('nilai-peserta.update', $nilai->id_riwayat) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Peserta</label>
                            <input type="text" class="form-control" value="{{ $nilai->pendaftaran->nama }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Tanggal Test</label>
                            <input type="date" class="form-control" name="tanggal_test" value="{{ $nilai->tanggal_test->format('Y-m-d') }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">Listening</label>
                                    <input type="number" class="form-control" name="listening" step="0.1" min="0" max="100" value="{{ $nilai->listening }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">Structure</label>
                                    <input type="number" class="form-control" name="structure" step="0.1" min="0" max="100" value="{{ $nilai->structure }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">Reading</label>
                                    <input type="number" class="form-control" name="reading" step="0.1" min="0" max="100" value="{{ $nilai->reading }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Javascripts -->
    <script src="{{ asset('assets/js-dashboard/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('assets/js-dashboard/demo.min.js?1692870487') }}" defer></script>
    
    <!-- Search Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[placeholder="Cari peserta..."]');
            const tableRows = document.querySelectorAll('tbody tr');

            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();

                tableRows.forEach(row => {
                    const nama = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    if (nama.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <!-- Score Calculation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to calculate total score for both add and edit forms
            function setupScoreCalculation(formId) {
                const form = document.querySelector(formId);
                if (!form) return;

                const inputs = ['listening', 'structure', 'reading'].map(name => 
                    form.querySelector(`input[name="${name}"]`)
                );

                inputs.forEach(input => {
                    input.addEventListener('input', function() {
                        validateScore(input);
                    });
                });
            }

            // Validate score input
            function validateScore(input) {
                let value = parseFloat(input.value);
                if (value < 0) input.value = 0;
                if (value > 100) input.value = 100;
            }

            // Setup calculation for both modals
            setupScoreCalculation('#modal-input-nilai form');
            document.querySelectorAll('[id^="modal-edit-nilai-"]').forEach(modal => {
                setupScoreCalculation(`#${modal.id} form`);
            });
        });
    </script>

    <!-- Alert Auto-dismiss -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('fade');
                    setTimeout(() => {
                        alert.remove();
                    }, 150);
                }, 3000);
            });
        });
    </script>

    <!-- Date Input Default Value -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            const dateInputs = document.querySelectorAll('input[type="date"]');
            dateInputs.forEach(input => {
                if (!input.value) {
                    input.value = today;
                }
            });
        });
    </script>

@endsection