@extends('layouts.app')

@section('content')
    <div class="container m-5">
        <div class="row w-100">
            <div class="col-md-12 d-flex">
                <div class="row">
                    <!-- kiri session -->
                    <div class="col-md-6 d-flex flex-column justify-content-start align-items-center">
                        <img src="{{ asset('assets/regis.png') }}" alt="Illustration" class="img-fluid">
                        <h3 class="text-center">Pendaftaran Toefl ITP</h3>
                        <p class="text-center text-muted">Seluruh pengguna dapat mendaftar akun secara manual.<br><a
                                href="{{ url('/') }}">Kembali Ke Halaman Utama</a></p>
                    </div>

                    <!-- kanan session -->
                    <div class="col-md-6 d-flex justify-content-end align-items-center">
                        <div class="card shadow p-3" style="width: 100%; border-radius: 12px;">
                            <h4 class="text-center mt-1">TOEFL - Daftar Akun</h4>

                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="name" class="form-label">Nama</label>
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="nim" class="form-label">Nomor Induk Mahasiswa (Nim)</label>
                                            <input id="nim" type="text"
                                                class="form-control @error('nim') is-invalid @enderror" name="nim"
                                                value="{{ old('nim') }}">
                                            @error('nim')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
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
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="prodi" class="form-label">Program Studi</label>
                                        <select id="prodi" class="form-control @error('prodi') is-invalid @enderror"
                                            name="prodi" required>
                                            <option value="">Pilih Program Studi</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="no_hp" class="form-label">Nomor HP Aktif</label>
                                            <input id="no_hp" type="text"
                                                class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                                value="{{ old('no_hp') }}" required>
                                            @error('no_hp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required>
                                            <small class="form-text text-muted">Gunakan 8 atau lebih karakter dengan sebuah
                                                huruf, angka, dan simbol.</small>
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

                                    <div class="col-md-6 mb-2">
                                        <label for="foto" class="form-label">Unggah Pas Foto *</label>
                                        <input id="foto" type="file"
                                            class="form-control @error('foto') is-invalid @enderror" name="foto" required>
                                        @error('foto') <!-- Perbaikan di sini -->
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>

                            <div class="form-check m-3">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label" for="terms">Saya menyetujui <a href="#"
                                        style="color: var(--primary-color);">Syarat yang berlaku</a></label>
                            </div>

                            <div class="d-grid m-3">
                                <button type="submit" class="btn btn-primary"
                                    style="background-color: var(--primary-color); color: white;">Daftar</button>
                            </div>
                            </form>

                            <div class="text-center m-1">
                                Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
                            </div>
                        </div>
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
    </script>
@endsection