<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Admin Dashboard</title>
    <!-- CSS files -->
    <link href="{{asset('assets/css-dashboard/tabler.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-flags.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-payments.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-vendors.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/demo.min.css?1692870487')}}" rel="stylesheet"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
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
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
      }
      
      .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
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
        background-color: var(--primary-color);
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
        background-color: var(--primary-color);
      }
      
      .chart-container {
        min-height: 300px;
      }
    </style>
  </head>
  <body>
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
                  <i class="far fa-calendar-alt me-1"></i> {{ now()->format('l, d F Y') }}
                </div>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    <a href="#" class="btn btn-white">
                      <i class="fas fa-file-export me-2"></i>
                      Export
                    </a>
                  </span>
                  <a href="#" class="btn btn-primary d-none d-sm-inline-block">
                    <i class="fas fa-plus me-2"></i>
                    Create new report
                  </a>
                  <a href="#" class="btn btn-primary d-sm-none btn-icon">
                    <i class="fas fa-plus"></i>
                  </a>
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
                      Kami senang Anda kembali! Pantau aktivitas terbaru, lihat statistik, dan kelola sistem Anda dengan mudah melalui dashboard ini.
                    </p>
                  </div>
                  <div class="d-none d-md-block">
                    <img src="{{ asset('assets/Welcome-cuate.png') }}" alt="Welcome Image" 
                         class="img-fluid" style="max-width: 250px; border-radius: 10px;">
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
                      <h3 class="mb-0 fw-bold">1,234</h3>
                      <p class="text-muted mb-0">Total Pengguna</p>
                    </div>
                  </div>
                  <div class="mt-3">
                    <div class="d-flex align-items-center">
                      <span class="text-success me-2">
                        <i class="fas fa-arrow-up"></i> 12%
                      </span>
                      <span class="text-muted small">dari bulan lalu</span>
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
                      <h3 class="mb-0 fw-bold">560</h3>
                      <p class="text-muted mb-0">Total Transaksi</p>
                    </div>
                  </div>
                  <div class="mt-3">
                    <div class="d-flex align-items-center">
                      <span class="text-success me-2">
                        <i class="fas fa-arrow-up"></i> 8.7%
                      </span>
                      <span class="text-muted small">dari bulan lalu</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-sm-6 col-lg-3">
              <div class="card stat-card shadow-sm mb-3">
                <div class="card-body p-3">
                  <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: rgba(33, 150, 243, 0.1);">
                      <i class="fas fa-file-alt fa-2x" style="color: var(--info-color);"></i>
                    </div>
                    <div>
                      <h3 class="mb-0 fw-bold">85</h3>
                      <p class="text-muted mb-0">Laporan Baru</p>
                    </div>
                  </div>
                  <div class="mt-3">
                    <div class="d-flex align-items-center">
                      <span class="text-danger me-2">
                        <i class="fas fa-arrow-down"></i> 3.2%
                      </span>
                      <span class="text-muted small">dari bulan lalu</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-sm-6 col-lg-3">
              <div class="card stat-card shadow-sm mb-3">
                <div class="card-body p-3">
                  <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: rgba(255, 152, 0, 0.1);">
                      <i class="fas fa-chart-pie fa-2x" style="color: var(--warning-color);"></i>
                    </div>
                    <div>
                      <h3 class="mb-0 fw-bold">Rp 45.6jt</h3>
                      <p class="text-muted mb-0">Total Pendapatan</p>
                    </div>
                  </div>
                  <div class="mt-3">
                    <div class="d-flex align-items-center">
                      <span class="text-success me-2">
                        <i class="fas fa-arrow-up"></i> 22.5%
                      </span>
                      <span class="text-muted small">dari bulan lalu</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Quick Actions & Recent Activity -->
          <div class="row mb-4">
            <div class="col-lg-8">
              <div class="card shadow-sm mb-4">
                <div class="card-header bg-transparent">
                  <h3 class="card-title">Aksi Cepat</h3>
                </div>
                <div class="card-body">
                  <div class="row g-3">
                    <div class="col-6">
                      <a href="#" class="quick-action d-block text-center p-3 border rounded">
                        <i class="fas fa-user-plus fa-2x mb-2" style="color: var(--primary-color);"></i>
                        <div>Tambah Pengguna</div>
                      </a>
                    </div>
                    <div class="col-6">
                      <a href="#" class="quick-action d-block text-center p-3 border rounded">
                        <i class="fas fa-file-invoice fa-2x mb-2" style="color: var(--primary-color);"></i>
                        <div>Buat Laporan</div>
                      </a>
                    </div>
                    <div class="col-6">
                      <a href="#" class="quick-action d-block text-center p-3 border rounded">
                        <i class="fas fa-cog fa-2x mb-2" style="color: var(--primary-color);"></i>
                        <div>Pengaturan</div>
                      </a>
                    </div>
                    <div class="col-6">
                      <a href="#" class="quick-action d-block text-center p-3 border rounded">
                        <i class="fas fa-bell fa-2x mb-2" style="color: var(--primary-color);"></i>
                        <div>Notifikasi</div>
                      </a>
                    </div>
                    <div class="col-6">
                      <a href="#" class="quick-action d-block text-center p-3 border rounded">
                        <i class="fas fa-chart-bar fa-2x mb-2" style="color: var(--primary-color);"></i>
                        <div>Statistik</div>
                      </a>
                    </div>
                    <div class="col-6">
                      <a href="#" class="quick-action d-block text-center p-3 border rounded">
                        <i class="fas fa-question-circle fa-2x mb-2" style="color: var(--primary-color);"></i>
                        <div>Bantuan</div>
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
    
    <script>
      // Activity Chart
      var activityOptions = {
        series: [{
          name: 'Pengunjung',
          data: [31, 40, 28, 51, 42, 109, 100, 120, 80, 95, 110, 75]
        }, {
          name: 'Transaksi',
          data: [11, 32, 45, 32, 34, 52, 41, 62, 42, 55, 40, 30]
        }],
        chart: {
          height: 300,
          type: 'area',
          toolbar: {
            show: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
          width: 2
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        },
        tooltip: {
          theme: 'light'
        },
        colors: ['#4361ee', '#4caf50'],
        fill: {
          type: 'gradient',
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.2,
            stops: [0, 90, 100]
          }
        }
      };

      var activityChart = new ApexCharts(document.querySelector("#activity-chart"), activityOptions);
      activityChart.render();
      
      // User Distribution Chart
      var userDistOptions = {
        series: [44, 25, 16, 15],
        chart: {
          height: 300,
          type: 'donut',
        },
        labels: ['Desktop', 'Mobile', 'Tablet', 'Others'],
        colors: ['#4361ee', '#4caf50', '#ff9800', '#2196f3'],
        legend: {
          position: 'bottom'
        },
        plotOptions: {
          pie: {
            donut: {
              size: '70%'
            }
          }
        }
      };

      var userDistChart = new ApexCharts(document.querySelector("#user-distribution-chart"), userDistOptions);
      userDistChart.render();
    </script>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </body>
</html>