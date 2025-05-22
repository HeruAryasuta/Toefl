@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11 d-flex align-items-start min-vh-100 py-5">
            <!-- Left side illustration -->
            <div class="col-md-5 d-none d-md-block pe-5">
                <div class="position-relative text-center">
                    <img src="{{ asset('assets/regis.png') }}" alt="Illustration" class="img-fluid mb-4">
                </div>
                
                <h3 class="text-center mt-4 mb-3">Pendaftaran TOEFL</h3>
                <p class="text-center text-muted mb-4">Seluruh pengguna dapat mendaftar akun secara manual.</p>
                
                <div class="text-center mt-4">
                    <a href="{{ url('/') }}" class="btn btn-link text-decoration-none">Kembali Ke Halaman Utama</a>
                </div>
            </div>
            
            <!-- Right side form -->
            <div class="col-md-7">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="text-center mb-4">TOEFL - Daftar Akun</h4>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger py-3 mb-4" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                    name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <!-- NIM -->
                            <div class="mb-3">
                                <label for="nim" class="form-label">Nomor Induk Mahasiswa (NIM)</label>
                                <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" 
                                    name="nim" value="{{ old('nim') }}">
                                @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <!-- Fakultas dan Prodi -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fakultas" class="form-label">Fakultas</label>
                                    <select id="fakultas" class="form-control @error('fakultas') is-invalid @enderror" 
                                        name="fakultas" required>
                                        <option value="">Pilih Fakultas</option>
                                        <option value="Teknik">Fakultas Teknik</option>
                                        <option value="Fisipol">Fakultas Ilmu Sosial dan Ilmu Politik</option>
                                        <option value="Pertanian">Fakultas Pertanian</option>
                                        <option value="Ekonomi">Fakultas Ekonomi dan Bisnis</option>
                                        <option value="Hukum">Fakultas Hukum</option>
                                        <option value="Kedokteran">Fakultas Kedokteran</option>
                                        <option value="Keguruan">Fakultas Keguruan dan Ilmu Pendidikan</option>
                                    </select>
                                    @error('fakultas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="prodi" class="form-label">Program Studi</label>
                                    <select id="prodi" class="form-control @error('prodi') is-invalid @enderror" 
                                        name="prodi" required>
                                        <option value="">Pilih Program Studi</option>
                                    </select>
                                    @error('prodi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Tempat dan Tanggal Lahir -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input id="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                        name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                    @error('tempat_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                        name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                    @error('tanggal_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Email dan No HP -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                        name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="no_hp" class="form-label">Nomor HP Aktif</label>
                                    <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                        name="no_hp" value="{{ old('no_hp') }}" required>
                                    @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Password -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                        name="password" required>
                                    <small class="form-text text-muted">Gunakan 8 atau lebih karakter dengan sebuah huruf, angka, dan simbol.</small>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                                    <input id="password-confirm" type="password" class="form-control" 
                                        name="password_confirmation" required>
                                </div>
                            </div>
                            
                            <!-- Foto Upload -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="foto" class="form-label">Unggah Pas Foto *</label>
                                    <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" 
                                        name="foto" required onchange="previewImage(event)">
                                    @error('foto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <img id="foto-preview" src="#" alt="Preview Image" 
                                        style="display:none; width: 100%; height: 150px; object-fit: cover; border-radius: 6px; border: 1px solid #e0e0e0;"/>
                                </div>
                            </div>
                            
                            <!-- Terms Checkbox -->
                            <div class="form-check mb-4">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    Saya menyetujui <a href="#" class="text-decoration-none">Syarat yang berlaku</a>
                                </label>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="d-grid gap-2 mb-4">
                                <button type="submit" class="btn btn-primary py-2">
                                    Daftar
                                </button>
                            </div>
                            
                            <!-- Login Link -->
                            <div class="text-center">
                                <p class="mb-0">
                                    Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Masuk</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        
        reader.onload = function () {
            const output = document.getElementById('foto-preview');
            output.src = reader.result;
            output.style.display = 'block';  // Menampilkan gambar
        };
        
        if (file) {
            reader.readAsDataURL(file); // Membaca file sebagai URL data
        }
    }
</script>
@endsection

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }
    
    .card {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .form-control, .form-select {
        padding: 0.6rem 1rem;
        border-radius: 6px;
        border: 1px solid #e0e0e0;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #5468ff;
        box-shadow: 0 0 0 0.2rem rgba(84, 104, 255, 0.15);
    }
    
    .btn-primary {
        background-color: #0d3a69;
        border-color: #0d3a69;
        border-radius: 6px;
        font-weight: 500;
    }
    
    .btn-primary:hover {
        background-color: #0a2e53;
        border-color: #0a2e53;
    }
    
    a {
        color: #0d3a69;
    }
    
    a:hover {
        color: #0a2e53;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c2c7;
        color: #842029;
        border-radius: 6px;
    }
    
    .form-check-input:checked {
        background-color: #0d3a69;
        border-color: #0d3a69;
    }
    
    .form-check-input:focus {
        border-color: #5468ff;
        box-shadow: 0 0 0 0.2rem rgba(84, 104, 255, 0.15);
    }
</style>
@endpush