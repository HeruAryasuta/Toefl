@extends('layouts.app')

@section('content')
<div class="container m-5">
    <div class="row w-100">
        <div class="col-md-12 d-flex">
            <div class="row">
                <!-- kiri session -->
                <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ asset('assets/regis.png') }}" alt="Illustration" class="img-fluid">
                    <h3 class="text-center">Pendaftaran Toefl ITP</h3>
                    <p class="text-center text-muted">Seluruh pengguna dapat mendaftar akun secara manual.<br><a href="{{ url('/') }}">Kembali Ke Halaman Utama</a></p>
                </div>

                <!-- kanan session -->
                <div class="col-md-6 d-flex justify-content-end align-items-center">
                    <div class="card shadow p-3" style="width: 100%; border-radius: 12px;">
                        <h4 class="text-center mt-1">TOEFL - Daftar Akun</h4>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="nik" class="form-label">Nomor KTP (NIK)</label>
                                        <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required>
                                        @error('nik')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="phone" class="form-label">Nomor HP Aktif</label>
                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                        <small class="form-text text-muted">Gunakan 8 atau lebih karakter dengan sebuah huruf, angka, dan simbol.</small>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="password-confirm" class="form-label">Repeat Password</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="photo" class="form-label">Unggah Pas Foto *</label>
                                        <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" required>
                                        @error('photo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-check m-3">
                                    <input type="checkbox" class="form-check-input" id="terms" required>
                                    <label class="form-check-label" for="terms">Saya menyetujui <a href="#" style="color: var(--primary-color);">Syarat yang berlaku</a></label>
                                </div>

                                <div class="d-grid m-3">
                                    <button type="submit" class="btn btn-primary" style="background-color: var(--primary-color); color: white;">Daftar</button>
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
@endsection
