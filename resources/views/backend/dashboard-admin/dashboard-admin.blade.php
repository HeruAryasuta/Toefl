@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

  <style>
    :root {
    --primary-color: #213555;
    --secondary-color: #4E6D8B;
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
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    }

    .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .welcome-card {
    background: linear-gradient(135deg, #f5f7fb 0%, #e4e7ed 100%);
    border-radius: 16px;
    }

    .stat-card {
    border-radius: 12px;
    border: none;
    }

    .stat-card .icon-box {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    }

    .quick-action {
    border-radius: 10px;
    transition: all 0.3s ease;
    }

    .quick-action:hover {
    background-color: var(--secondary-color);
    color: white;
    }

    .quick-action:hover i {
    color: white;
    }

    .recent-activity {
    max-height: 400px;
    overflow-y: auto;
    }

    .activity-item {
    border-left: 3px solid #e9ecef;
    padding-left: 1.5rem;
    position: relative;
    }

    .activity-item::before {
    content: '';
    position: absolute;
    left: -6px;
    top: 0;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: var(--secondary-color);
    }

    .chart-container {
    min-height: 300px;
    }
  </style>

  <div class="page">
    <!-- Section Sidebar -->
    @include('backend.sidebar')

    <!-- Main Content -->
    <div class="page-wrapper">
    <div class="container-xl py-4">
      <!-- Header -->
      <div class="page-header d-print-none mb-4">
      <div class="row align-items-center">
        <div class="col">
        <h2 class="page-title">Dashboard</h2>
        <div class="text-muted mt-1">
          <i class="far fa-calendar-alt me-1"></i> {{ now()->translatedFormat('l, d F Y') }}
        </div>
        </div>
      </div>
      </div>

      <!-- Welcome Card -->
      <div class="row mb-4">
      <div class="col-12">
        <div class="card welcome-card shadow-sm border-0">
        <div class="card-body d-flex align-items-center justify-content-between p-4">
          <div>
          <h1 class="mb-2" style="font-weight: 700; color: var(--dark-color);">
            Selamat Datang, {{ Auth::user()->name }}
          </h1>
          <p class="mb-0" style="color: #6C757D; font-size: 16px; max-width: 600px;">
            Kami senang Anda kembali! Pantau aktivitas terbaru, lihat statistik, dan kelola sistem Anda dengan
            mudah melalui dashboard ini.
          </p>
          </div>
          <div class="d-none d-md-block">
          <img src="{{ asset('assets/Welcome-cuate.png') }}" alt="Welcome Image" class="img-fluid"
            style="max-width: 250px; border-radius: 10px;">
          </div>
        </div>
        </div>
      </div>
      </div>

      <!-- Stats Cards -->
      <div class="row mb-4">
      <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm mb-3">
        <div class="card-body p-3">
          <div class="d-flex align-items-center">
          <div class="icon-box me-3" style="background-color: rgba(67, 97, 238, 0.1);">
            <i class="fas fa-users fa-2x" style="color: var(--primary-color);"></i>
          </div>
          <div>
            <h3 class="mb-0 fw-bold">{{ number_format($totalUsers) }}</h3>
            <p class="text-muted mb-0">Total Pengguna</p>
          </div>
          </div>
        </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm mb-3">
        <div class="card-body p-3">
          <div class="d-flex align-items-center">
          <div class="icon-box me-3" style="background-color: rgba(76, 175, 80, 0.1);">
            <i class="fas fa-shopping-cart fa-2x" style="color: var(--success-color);"></i>
          </div>
          <div>
            <h3 class="mb-0 fw-bold">{{ number_format($transaksiCount) }}</h3>
            <p class="text-muted mb-0">Total Transaksi</p>
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>

      <div class="container mx-auto mb-8">
      <h2 class="text-center text-xl font-bold mb-4">Jumlah Peserta Per Bulan</h2>
      <canvas id="grafikJumlahPeserta" width="400" height="100"></canvas>
      </div>

      <div class="container mx-auto mb-8">
      <h2 class="text-center text-xl font-bold mb-4">Nilai Tertinggi Per Bulan</h2>
      <canvas id="grafikNilaiTertinggi" width="400" height="100"></canvas>
      </div>

      <!-- Quick Actions & Recent Activity -->
      <div class="row mb-4">
      <div class="col-12">
        <div class="card shadow-sm mb-4">
        <div class="card-header bg-transparent">
          <h3 class="card-title">Aksi Cepat</h3>
        </div>
        <div class="card-body">
          <div class="row g-3">
          <div class="col-6">
            <a href="{{ route('data-peserta') }}" class="quick-action d-block text-center p-3 border rounded">
            <i class="fas fa-users fa-2x mb-2" style="color: var(--primary-color);"></i>
            <div>Data Peserta</div>
            </a>
          </div>
          <div class="col-6">
            <a href="{{ route('pendaftaran') }}" class="quick-action d-block text-center p-3 border rounded">
            <i class="fas fa-user-check fa-2x mb-2" style="color: var(--primary-color);"></i>
            <div>Data Pendaftar</div>
            </a>
          </div>
          <div class="col-6">
            <a href="{{ route('penjadwalan') }}" class="quick-action d-block text-center p-3 border rounded">
            <i class="fas fa-calendar-alt fa-2x mb-2" style="color: var(--primary-color);"></i>
            <div>Penjadwalan</div>
            </a>
          </div>
          <div class="col-6">
            <a href="{{ route('nilai-peserta') }}" class="quick-action d-block text-center p-3 border rounded">
            <i class="fas fa-graduation-cap fa-2x mb-2" style="color: var(--primary-color);"></i>
            <div>Nilai Peserta</div>
            </a>
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>

  <!-- Libs JS -->
  <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const labelBulan = {!! $labelBulan !!};
    const jumlahPerbulan = {!! $jumlahPerbulan !!};
    const nilaiTertinggi = {!! $nilaiTertinggi !!};

    // Chart Jumlah Peserta
    const ctxPeserta = document.getElementById('grafikJumlahPeserta').getContext('2d');
    new Chart(ctxPeserta, {
    type: 'line',
    data: {
      labels: labelBulan,
      datasets: [{
      label: 'Jumlah Peserta',
      data: jumlahPerbulan,
      borderColor: 'rgba(52, 152, 219, 1)',
      backgroundColor: 'rgba(52, 152, 219, 0.2)',
      tension: 0.4,
      fill: true
      }]
    },
    options: {
      responsive: true,
      scales: {
      y: {
        beginAtZero: true
      }
      }
    }
    });

    // Chart Nilai Tertinggi
    const ctxNilai = document.getElementById('grafikNilaiTertinggi').getContext('2d');
    new Chart(ctxNilai, {
    type: 'line',
    data: {
      labels: labelBulan,
      datasets: [{
      label: 'Nilai Tertinggi',
      data: nilaiTertinggi,
      borderColor: 'rgba(231, 76, 60, 1)',
      backgroundColor: 'rgba(231, 76, 60, 0.2)',
      tension: 0.4,
      fill: true
      }]
    },
    options: {
      responsive: true,
      scales: {
      y: {
        beginAtZero: true
      }
      }
    }
    });
  </script>


  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
@endsection