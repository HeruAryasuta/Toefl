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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <style>
      .profile-header {
        background: linear-gradient(135deg, #6baace, #375a7f);
        padding: 2rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        color: white;
      }
      .profile-photo {
        background-color: white;
        padding: 0.3rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      }
      .info-card {
        transition: all 0.3s ease;
      }
      .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      }
      .info-icon {
        font-size: 1.5rem;
        color: #375a7f;
        margin-right: 1rem;
      }
      .edit-button {
        transition: all 0.3s ease;
      }
      .edit-button:hover {
        background-color: #375a7f;
        color: white;
      }
    </style>
  </head>
  <body class="bg-light">
    <div class="page">
      <!-- Section Sidebar -->
      @include('backend.sidebar')
      <!-- Konten Utama -->
      <div class="page-wrapper">
        <div class="container-xl py-4">
          
          <div class="profile-header d-flex align-items-center">
            <div class="me-4">
              @if(Auth::user()->foto)
              <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil" class="profile-photo img-fluid rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
              @else
              <img src="{{ asset('assets/default-avatar.png') }}" alt="Foto Profil" class="profile-photo img-fluid rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
              @endif
            </div>
            <div>
              <h1 class="mb-0">{{ Auth::user()->name }}</h1>
              <p class="text-white-50 mb-0">{{ Auth::user()->nim }} • {{ Auth::user()->prodi }}</p>
            </div>
            <div class="ms-auto">
              <button class="btn btn-light edit-button">
                <i class="fas fa-edit me-2"></i> Edit Profile
              </button>
            </div>
          </div>
          
          <div class="row">
            <!-- Personal Information -->
            <div class="col-md-6 mb-4">
              <div class="card info-card h-100">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-user-circle me-2"></i>
                    Informasi Pribadi
                  </h3>
                </div>
                <div class="card-body">
                  <div class="d-flex align-items-center mb-3">
                    <div class="info-icon">
                      <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div>
                      <div class="text-muted small">Fakultas</div>
                      <div class="fw-bold">{{ Auth::user()->fakultas }}</div>
                    </div>
                  </div>
                  
                  <div class="d-flex align-items-center mb-3">
                    <div class="info-icon">
                      <i class="fas fa-book"></i>
                    </div>
                    <div>
                      <div class="text-muted small">Program Studi</div>
                      <div class="fw-bold">{{ Auth::user()->prodi }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Contact Information -->
            <div class="col-md-6 mb-4">
              <div class="card info-card h-100">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-address-card me-2"></i>
                    Informasi Kontak
                  </h3>
                </div>
                <div class="card-body">
                  <div class="d-flex align-items-center mb-3">
                    <div class="info-icon">
                      <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                      <div class="text-muted small">Email</div>
                      <div class="fw-bold">{{ Auth::user()->email }}</div>
                    </div>
                  </div>
                  
                  <div class="d-flex align-items-center mb-3">
                    <div class="info-icon">
                      <i class="fas fa-phone"></i>
                    </div>
                    <div>
                      <div class="text-muted small">Nomor Handphone</div>
                      <div class="fw-bold">{{ Auth::user()->no_hp }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Additional Actions -->
          <div class="row mt-3">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-primary">
                      <i class="fas fa-download me-2"></i> Download Data
                    </button>
                    <button class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
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

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </body>
</html>