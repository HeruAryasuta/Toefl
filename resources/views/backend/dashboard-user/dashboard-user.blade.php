@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')


  <style>
    :root {
    --primary-color: #3498db;
    --secondary-color: #2ecc71;
    --accent-color: #f39c12;
    --text-dark: #2c3e50;
    --text-light: #7f8c8d;
    --bg-light: #f5f7fb;
    --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    body {
    background-color: var(--bg-light);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .welcome-card {
    background: linear-gradient(120deg, #f6f9fc, #eef2f7);
    border: none !important;
    overflow: hidden;
    position: relative;
    }

    .welcome-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 200%;
    background: linear-gradient(120deg, rgba(52, 152, 219, 0.03), rgba(46, 204, 113, 0.03));
    transform: rotate(-45deg);
    z-index: 0;
    }

    .stats-card {
    transition: all 0.3s ease;
    border: none !important;
    }

    .stats-card:hover {
    transform: translateY(-5px);
    }

    .quick-action-card {
    transition: all 0.3s ease;
    border: none !important;
    }

    .quick-action-card:hover {
    transform: translateY(-3px);
    }

    .card-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    font-size: 1.5rem;
    }

    .upcoming-test-card {
    border-left: 4px solid var(--primary-color) !important;
    }

    .section-title {
    font-weight: 600;
    color: var(--text-dark);
    position: relative;
    padding-left: 15px;
    margin-bottom: 1.5rem;
    }

    .section-title::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 18px;
    background: var(--primary-color);
    border-radius: 4px;
    }

    .progress {
    height: 8px;
    border-radius: 4px;
    }
  </style>

  <div class="page">
    <!-- Section Sidebar -->
    @include('backend.sidebar')

    <!-- Konten Utama -->
    <div class="page-wrapper">
    <div class="container-xl py-4">

      <!-- Welcome Section -->
      <div class="row mb-4">
      <div class="col-12">
        <div class="card welcome-card shadow">
        <div class="card-body d-flex align-items-center p-4">
          <div class="z-index-1">
          <h1 class="mb-2" style="font-weight: 600; color: var(--text-dark);">
            Selamat Datang, {{ Auth::user()->name }}
          </h1>
          <p class="mb-4" style="color: var(--text-light); font-size: 16px; max-width: 600px;">
            Selamat datang di dashboard TOEFL Prediction. Di sini Anda dapat melihat jadwal tes, hasil, dan
            informasi penting lainnya.
          </p>
          <a href="{{ route('jadwal-user') }}" class="btn btn-primary px-4 py-2">
            <i class="fas fa-calendar-alt me-2"></i> Lihat Jadwal TOEFL
          </a>
          </div>
          <div class="ms-auto d-none d-md-block">
          <img src="{{ asset('assets/Welcome-cuate.png') }}" alt="Welcome Image" class="img-fluid"
            style="max-width: 240px; z-index: 1; position: relative;">
          </div>
        </div>
        </div>
      </div>
      </div>

      <!-- Stats Section -->
      <h3 class="section-title">Ringkasan</h3>
      <div class="row mb-4">

      <!-- Test Count -->
      <div class="col-md-4 mb-3">
        <div class="card stats-card shadow-sm h-100">
        <div class="card-body p-4">
          <div class="d-flex align-items-center mb-3">
          <div class="card-icon me-3"
            style="background-color: rgba(52, 152, 219, 0.1); color: var(--primary-color);">
            <i class="fas fa-clipboard-list"></i>
          </div>
          <div>
            <h4 class="mb-0">{{ $jadwalCount }}</h4>
            <span class="text-muted">Jadwal Tersedia</span>
          </div>
          </div>
          <div class="progress" style="height: 8px;">
          <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $progress }}%"
            aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
          </div>
          </div>
        </div>
        </div>
      </div>


      <!-- Best Score -->
      <div class="col-md-4 mb-3">
        <div class="card stats-card shadow-sm h-100">
        <div class="card-body p-4">
          <div class="d-flex align-items-center mb-3">
          <div class="card-icon me-3"
            style="background-color: rgba(46, 204, 113, 0.1); color: var(--secondary-color);">
            <i class="fas fa-trophy"></i>
          </div>
          <div>
            <h4 class="mb-0">{{ $skorTertinggi }}</h4>
            <span class="text-muted">Skor Tertinggi</span>
          </div>
          </div>
          <div class="progress" style="height: 8px;">
          <div class="progress-bar bg-success" role="progressbar"
            style="width: {{ min(($skorTertinggi / 677) * 100, 100) }}%" aria-valuenow="{{ $skorTertinggi }}"
            aria-valuemin="0" aria-valuemax="677">
          </div>
          </div>
        </div>
        </div>
      </div>

      <!-- Upcoming Test -->
      <div class="col-md-4 mb-3">
        <div class="card stats-card shadow-sm h-100">
        <div class="card-body p-4">
          <div class="d-flex align-items-center mb-3">
          <div class="card-icon me-3"
            style="background-color: rgba(243, 156, 18, 0.1); color: var(--accent-color);">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <div>
            <h4 class="mb-0">{{ $pendaftaranCount }}</h4>
            <span class="text-muted">Tes Mendatang</span>
          </div>
          </div>
          <div class="progress" style="height: 8px;">
          <div class="progress-bar bg-warning" role="progressbar"
            style="width: {{ min(($pendaftaranCount / 10) * 100, 100) }}%" aria-valuenow="{{ $pendaftaranCount }}"
            aria-valuemin="0" aria-valuemax="10">
          </div>
          </div>
        </div>
        </div>
      </div>


      <!-- Quick Actions & Upcoming Test -->
      <div class="row">
        <!-- Quick Actions -->
        <div class="col-md-6 mb-4">
        <h3 class="section-title">Aksi Cepat</h3>
        <div class="row">
          <!-- Edit Profile -->
          <div class="col-6 mb-3">
          <a href="{{ route('biodata') }}" class="text-decoration-none">
            <div class="card quick-action-card shadow-sm h-100">
            <div class="card-body p-3 text-center">
              <div class="d-flex flex-column align-items-center">
              <div class="card-icon mb-2"
                style="background-color: rgba(52, 152, 219, 0.1); color: var(--primary-color);">
                <i class="fas fa-user-edit"></i>
              </div>
              <h5 class="mb-0 text-body">Edit Profil</h5>
              </div>
            </div>
            </div>
          </a>
          </div>

          <!-- Register Test -->
          <div class="col-6 mb-3">
          <a href="{{ route('jadwal-user') }}" class="text-decoration-none">
            <div class="card quick-action-card shadow-sm h-100">
            <div class="card-body p-3 text-center">
              <div class="d-flex flex-column align-items-center">
              <div class="card-icon mb-2"
                style="background-color: rgba(46, 204, 113, 0.1); color: var(--secondary-color);">
                <i class="fas fa-clipboard-check"></i>
              </div>
              <h5 class="mb-0 text-body">Daftar Tes</h5>
              </div>
            </div>
            </div>
          </a>
          </div>

          <!-- View Results -->
          <div class="col-6 mb-3">
          <a href="{{ route('jadwal-user') }}" class="text-decoration-none">
            <div class="card quick-action-card shadow-sm h-100">
            <div class="card-body p-3 text-center">
              <div class="d-flex flex-column align-items-center">
              <div class="card-icon mb-2" style="background-color: rgba(155, 89, 182, 0.1); color: #9b59b6;">
                <i class="fas fa-chart-line"></i>
              </div>
              <h5 class="mb-0 text-body">Lihat Hasil</h5>
              </div>
            </div>
            </div>
          </a>
          </div>

          <!-- Help/Support -->
          <div class="col-6 mb-3">
          <a href="#" class="text-decoration-none">
            <div class="card quick-action-card shadow-sm h-100">
            <div class="card-body p-3 text-center">
              <div class="d-flex flex-column align-items-center">
              <div class="card-icon mb-2"
                style="background-color: rgba(243, 156, 18, 0.1); color: var(--accent-color);">
                <i class="fas fa-question-circle"></i>
              </div>
              <h5 class="mb-0 text-body">Bantuan</h5>
              </div>
            </div>
            </div>
          </a>
          </div>
        </div>
        </div>
        <!-- Upcoming Test -->
        <div class="col-md-6 mb-4">
            @if ($pendaftaran->isNotEmpty())
                <h3 class="section-title">Tes Mendatang</h3>
                @foreach($pendaftaran as $daftar)
                    @if ($daftar->jadwal)  {{-- Pastikan ada jadwal terkait --}}
                        <div class="card upcoming-test-card shadow-sm mb-4">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="card-icon me-3"
                                        style="background-color: rgba(52, 152, 219, 0.1); color: var(--primary-color);">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-0">{{ $daftar->jadwal->nama_test ?? 'TOEFL Prediction Test' }}</h4>
                                        <span class="text-muted">
                                            {{ \Carbon\Carbon::parse($daftar->jadwal->tanggal_test)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-clock text-muted me-2"></i>
                                        <span>{{ $daftar->jadwal->jam_test ?? '-' }} - Selesai WIB</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                        <span>{{ $daftar->jadwal->lokasi ?? 'Lokasi belum tersedia' }}</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold">{{ $daftar->status_pendaftaran }}</span>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="#" class="btn btn-outline-secondary">
                                        <i class="fas fa-info-circle me-1"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="alert alert-warning">
                    Anda belum mendaftar untuk tes TOEFL.
                </div>
            @endif
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
    </form>

  @endsection