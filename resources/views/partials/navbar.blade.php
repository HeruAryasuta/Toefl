<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/logo_upt.png') }}" alt="Logo" class="me-2">
            <span class="font-weight-bold text-dark">TOEFL UNIMAL</span>
        </a>

        <!-- Button for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ url('#home') }}">BERANDA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ url('/profil') }}">PROFIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ url('#jadwal') }}">JADWAL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ url('#dokumen') }}">DOKUMEN DAN PANDUAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ url('#faq') }}">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-success" href="{{ route('login') }}">Masuk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
