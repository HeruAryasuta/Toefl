@extends('layouts.app')

@section('title', 'Halaman Utama')

@section('content')
    @include('partials.navbar')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Halaman Utama -->
    <div class="container-fluid" id="home">
        <div class="row">
            <div class="col-12 p-0 position-relative">
                <div class="hero-overlay"
                    style="background: rgba(0,0,0,0.5); position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                </div>
                <img src="{{ asset('assets/upt1.png') }}" alt="Tes TOEFL Prediction" class="img-fluid w-100"
                    style="object-fit: cover; height: 550px;" loading="lazy">
                <div class="position-absolute text-center" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <h1 class="text-white display-4 fw-bold mb-3">Tes TOEFL Prediction</h1>
                    <p class="text-white lead mb-4">Tingkatkan kemampuan bahasa Inggris Anda dengan TOEFL Prediction Test
                    </p>
                    <a href="#jadwal" class="btn btn-color-primary btn-lg px-4 rounded-pill">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Halaman Informasi -->
    <!-- Judul Section -->
    <div class="text-center mb-5 mt-5">
        <h2 class="color-primary font-weight-bold">Tes TOEFL Prediction</h2>
        <p class="text-muted">Prediksi tes untuk mengukur kemampuan bahasa Inggris peserta guna memenuhi kebutuhan akademik
            dan profesional.</p>
    </div>

    <!-- Card Section -->
    <div class="container py-5">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-primary-color mb-3"></i>
                        <h3 class="fw-bold">1000+</h3>
                        <p class="text-muted">Peserta Terdaftar</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-certificate fa-3x text-primary-color mb-3"></i>
                        <h3 class="fw-bold">98%</h3>
                        <p class="text-muted">Tingkat Kelulusan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-star fa-3x text-primary-color mb-3"></i>
                        <h3 class="fw-bold">4.8/5</h3>
                        <p class="text-muted">Rating Kepuasan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Section -->
    <h1 class="text-center color-primary mt-5" id="jadwal">Jadwal Tes TOEFL</h1>
    <div class="container mb-5" style="background-color: var(--primary-color); border-radius: 8px; padding: 20px;">
        <!-- Bagian Jadwal Tes -->
        <div class="container mt-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Jadwal TOEFL Prediction</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Tes</th>
                                    <th>Waktu</th>
                                    <th>Lokasi</th>
                                    <th>Kuota</th>
                                    <th>Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jadwalTests as $jadwal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($jadwal->tanggal_test)->translatedFormat('j F Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($jadwal->jam_test)->format('H:i') }}</td>
                                        <td>{{ $jadwal->lokasi }}</td>
                                        <td>{{ $jadwal->kuota }}</td>
                                        <td>
                                            <a href=""{{ route('login') }}" class="btn btn-primary btn-sm">Daftar</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Jadwal belum tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div>Total Baris: {{ $jadwalTests->count() }}</div>
                    {{ $jadwalTests->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Section Dokumen dan Panduan -->
    <div class="container p-4 mb-5" style="background-color: var(--primary-color); border-radius: 8px;">
        <div class="row align-items-center mb-4">
            <div class="col">
                <h2 class="mb-1 text-white">Dokumen dan Panduan</h2>
                <p class="text-white-50 mb-0">Panduan lengkap untuk peserta TOEFL</p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item bg-transparent border-0 mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/pdf-icon.png') }}" alt="PDF" class="me-3" style="width: 40px;">
                        <div>
                            <h6 class="mb-0 text-white">Panduan Pendaftaran</h6>
                            <small class="text-white-50">Panduan lengkap proses pendaftaran</small>
                        </div>
                    </div>
                    <a href="{{ url('assets/Panduan_Pembayaran_TOEFL.pdf')  }}" class="btn btn-light btn-sm">
                        <i class="fas fa-download me-1"></i> Unduh
                    </a>
                </div>
            </div>
            <div class="list-group-item bg-transparent border-0">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/pdf-icon.png') }}" alt="PDF" class="me-3" style="width: 40px;">
                        <div>
                            <h6 class="mb-0 text-white">Panduan Pembayaran</h6>
                            <small class="text-white-50">Cara melakukan pembayaran</small>
                        </div>
                    </div>
                    <a href="{{ url('assets/Panduan_Pembayaran_TOEFL.pdf') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-download me-1"></i> Unduh
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- Frequently Asked Questions (FAQ) -->
    <div class="container mt-5 mb-5" id="faq">
        <h1 class="text-center color-primary">Frequently Asked Questions (FAQ)</h1>
        <div class="accordion" id="faqAccordion">
            <!-- Pertanyaan 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1"
                        aria-expanded="true" aria-controls="faqCollapse1">
                        Apa itu TOEFL Prediction?
                    </button>
                </h2>
                <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        TOEFL Prediction adalah tes yang dirancang untuk mengukur kemampuan bahasa Inggris seseorang sebagai
                        persiapan untuk tes TOEFL resmi atau untuk memenuhi kebutuhan akademik dan profesional.
                    </div>
                </div>
            </div>

            <!-- Pertanyaan 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                        Siapa yang bisa mengikuti tes TOEFL Prediction?
                    </button>
                </h2>
                <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Tes ini dapat diikuti oleh mahasiswa, umum, atau siapa saja yang ingin mengetahui kemampuan bahasa
                        Inggrisnya sebagai persiapan untuk kebutuhan akademik atau profesional.
                    </div>
                </div>
            </div>

            <!-- Pertanyaan 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                        Bagaimana cara mendaftar tes TOEFL Prediction?
                    </button>
                </h2>
                <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Anda dapat mendaftar dengan mengklik tombol "Daftar Sekarang" pada halaman utama, mengisi formulir
                        pendaftaran, dan menyelesaikan pembayaran sesuai panduan yang tersedia.
                    </div>
                </div>
            </div>

            <!-- Pertanyaan 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                        Berapa biaya untuk mengikuti tes TOEFL Prediction?
                    </button>
                </h2>
                <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Biaya tes TOEFL Prediction adalah Rp50.000 untuk mahasiswa dan Rp100.000 untuk peserta umum.
                    </div>
                </div>
            </div>

            <!-- Pertanyaan 5 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                        Apakah saya akan mendapatkan sertifikat setelah mengikuti tes?
                    </button>
                </h2>
                <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Ya, peserta yang telah mengikuti tes akan mendapatkan sertifikat sebagai bukti hasil tes TOEFL
                        Prediction.
                    </div>
                </div>
            </div>

            <!-- Pertanyaan 6 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading6">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
                        Di mana lokasi pelaksanaan tes TOEFL Prediction?
                    </button>
                </h2>
                <div id="faqCollapse6" class="accordion-collapse collapse" aria-labelledby="faqHeading6"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Lokasi tes dapat dilihat pada tabel jadwal tes di halaman utama. Pastikan Anda memeriksa tanggal,
                        waktu, dan lokasi tes sebelum mendaftar.
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @include('partials.scrool-to-top')
    @include('partials.footer')
@endsection