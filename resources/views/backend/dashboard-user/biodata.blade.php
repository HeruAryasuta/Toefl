@extends('layouts.app')

@section('title', 'Biodata')

@section('content')

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
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .info-card {
    transition: all 0.3s ease;
    }

    .info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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

    .modal-header {
    border-bottom: 1px solid #e5e7eb;
    padding: 1rem 1.5rem;
    }

    .modal-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1f2937;
    }

    .form-label {
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
    }

    .form-control {
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    padding: 0.5rem 0.75rem;
    transition: all 0.15s ease-in-out;
    }

    .form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
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
      <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil"
        class="profile-photo img-fluid rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
    @else
    <img src="{{ asset('assets/default-avatar.png') }}" alt="Foto Profil"
      class="profile-photo img-fluid rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
  @endif
        </div>
        <div>
        <h1 class="mb-0">{{ Auth::user()->name }}</h1>
        <p class="text-white-50 mb-0">{{ Auth::user()->nim }} • {{ Auth::user()->prodi }}</p>
        </div>
        <div class="ms-auto">
        <button class="btn btn-light edit-button" data-bs-toggle="modal" data-bs-target="#editProfileModal">
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

      </div>
    </div>
    </div>

    <!-- Modal Edit Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">
        <i class="fas fa-user-edit me-2 text-primary"></i>
        Edit Profile
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('biodata.update', $users->id_users) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
        <!-- Name Field -->
        <div class="mb-3">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
        </div>

        <!-- Nim Field -->
        <div class="mb-3">
          <label for="nim" class="form-label">Nim</label>
          <input type="text" class="form-control" id="nim" name="nim" value="{{ auth()->user()->nim }}" required>
        </div>

        <!-- Fakultas Field -->
        <div class="mb-3">
          <label for="fakultas" class="form-label">Fakultas</label>
          <select id="fakultas" class="form-control @error('fakultas') is-invalid @enderror" name="fakultas"
          required>
          <option value="">{{ auth()->user()->fakultas }}</option>
          <option value="Teknik">Fakultas Teknik</option>
          <option value="Fisipol">Fakultas Ilmu Sosial dan Ilmu Politik</option>
          <option value="Pertanian">Fakultas Pertanian</option>
          <option value="Ekonomi">Fakultas Ekonomi dan Bisnis</option>
          <option value="Hukum">Fakultas Hukum</option>
          <option value="Kedokteran">Fakultas Kedokteran</option>
          <option value="Keguruan">Fakultas Keguruan dan Ilmu Pendidikan</option>
          </select>
        </div>

        <!-- Prodi Field -->
        <div class="mb-3">
          <label for="prodi" class="form-label">Program Studi</label>
          <select id="prodi" class="form-control @error('prodi') is-invalid @enderror" name="prodi" required>
          <option value="">{{ auth()->user()->prodi }}</option>
          </select>
        </div>

        <!-- Email Field -->
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}"
          required>
        </div>

        <!-- Phone Field -->
        <div class="mb-3">
          <label for="no_hp" class="form-label">Nomor Telepon</label>
          <input type="tel" class="form-control" id="no_hp" name="no_hp" value="{{ auth()->user()->no_hp }}">
        </div>

        <!-- Password Fields -->
        <div class="mb-3">
          <label for="current_password" class="form-label">Password Saat Ini</label>
          <input type="password" class="form-control" id="current_password" name="current_password">
          <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
        </div>

        <div class="mb-3">
          <label for="new_password" class="form-label">Password Baru</label>
          <input type="password" class="form-control" id="new_password" name="new_password">
        </div>

        <div class="mb-3">
          <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
          <input type="password" class="form-control" id="new_password_confirmation"
          name="new_password_confirmation">
        </div>

        <div class="mb-3 text-center">
          <img id="previewImage"
          src="{{ auth()->user()->foto ? asset('storage/' . auth()->user()->foto) : asset('images/default-profile.png') }}"
          alt="Preview" class="img-thumbnail" style="max-width: 150px;">
        </div>

        <div class="mb-3">
          <label for="photoInput" class="form-label">Pilih Foto Baru</label>
          <input type="file" class="form-control" id="photoInput" accept="image/*">
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-save me-2"></i>
          Simpan Perubahan
        </button>
        </div>
      </form>
      </div>
    </div>
    </div>
    <!-- Libs JS -->
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const fakultasProdi = {
      Teknik: [
      'Teknik Sipil', 'Teknik Mesin', 'Teknik Industri', 'Teknik Kimia',
      'Teknik Elektro', 'Arsitektur', 'Teknik Informatika', 'Sistem Informasi',
      'Teknik Material', 'Teknik Logistik'
      ],
      Fisipol: [
      'Administrasi Publik', 'Ilmu Politik', 'Antropologi', 'Ilmu Komunikasi',
      'Sosiologi', 'Administrasi Bisnis'
      ],
      Pertanian: [
      'Agroekoteknologi', 'Agribisnis', 'Akuakultur', 'Ilmu Kelautan'
      ],
      Ekonomi: [
      'Manajemen', 'Akuntansi', 'Ekonomi Pembangunan', 'Ekonomi Islam', 'Kewirausahaan'
      ],
      Hukum: [
      'Ilmu Hukum'
      ],
      Kedokteran: [
      'Pendidikan Profesi Dokter', 'Kedokteran', 'Psikologi', 'Keperawatan (D3)'
      ],
      Keguruan: [
      'Pendidikan Matematika', 'Pendidikan Fisika', 'Pendidikan Kimia',
      'Pendidikan Bahasa Indonesia', 'Pendidikan Vokasional Teknik Mesin', 'Pendidikan Profesi Guru'
      ]
    };

    // Ambil elemen dropdown fakultas dan prodi
    const fakultasDropdown = document.getElementById('fakultas');
    const prodiDropdown = document.getElementById('prodi');

    // Fungsi untuk mengupdate prodi berdasarkan fakultas yang dipilih
    fakultasDropdown.addEventListener('change', function () {
      const fakultas = fakultasDropdown.value;
      prodiDropdown.innerHTML = '<option value="">Pilih Program Studi</option>'; // Reset prodi options

      if (fakultas && fakultasProdi[fakultas]) {
      fakultasProdi[fakultas].forEach(prodi => {
        const option = document.createElement('option');
        option.value = prodi;
        option.textContent = prodi;
        prodiDropdown.appendChild(option);
      });
      }
    });
    </script>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
    </form>
  @endsection