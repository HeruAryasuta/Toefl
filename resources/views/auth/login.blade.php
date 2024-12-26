@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row w-100">
        <!-- Left Section -->
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('assets/login.png') }}" alt="Illustration" class="img-fluid mb-4" style="max-width: 80%;">
            <h2 class="text-center">Toefl Prediction</h2>
            <p class="text-center text-muted">
                Aplikasi yang menyediakan layanan penjadwalan dan Pendaftaran TOEFL.
            </p>
            <a href="/" class="text-primary">Kembali Ke Halaman Utama</a>
        </div>

        <!-- Right Section -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="card shadow p-4" style="width: 100%; max-width: 400px; border-radius: 12px;">
                <h4 class="text-center mb-4">TOEFL</h4>
                <p class="text-center text-muted">Akun | Mahasiswa</p>
                <p class="text-center text-muted">Bagi Pengguna Luar UNIMAL dapat login dengan NIK dan Password terdaftar</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">NIK/NIM</label>
                        <input id="email" type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 text-end">
                        <a href="{{ route('password.request') }}" style="color: var(--primary-color);">Lupa Password? Hubungi Admin</a>
                    </div>

                    <button type="submit" class="btn w-100" style="background-color: var(--primary-color); color: white;">Masuk</button>
                </form>

                <p class="text-center text-muted mt-3">Bagi pengguna di luar UNIMAL, Belum ada akun? <a href="/register" class="text-primary">Daftar</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
