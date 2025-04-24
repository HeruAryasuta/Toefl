@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/side-bar.css') }}">

<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="light">
    <div class="container-fluid p-0">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
            <i class="fas fa-bars"></i>
        </button>

        <a href="/" class="navbar-brand">
            <img src="{{asset('assets/logo_upt.png')}}" alt="Logo" class="navbar-brand-image" />
            <span class="navbar-brand-text">UPT</span>
        </a>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav">
                @if(auth()->user()->role === 'admin')
                    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <span class="nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </span>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('data-peserta') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('data-peserta') }}">
                            <span class="nav-link-icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <span class="nav-link-title">Data Pengguna</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('pendaftaran') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pendaftaran') }}">
                            <span class="nav-link-icon">
                                <i class="fas fa-file-signature"></i>
                            </span>
                            <span class="nav-link-title">Pendaftaran</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('penjadwalan') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('penjadwalan') }}">
                            <span class="nav-link-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                            <span class="nav-link-title">Penjadwalan</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('nilai-peserta') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('nilai-peserta') }}">
                            <span class="nav-link-icon">
                                <i class="fas fa-chart-bar"></i>
                            </span>
                            <span class="nav-link-title">Data Nilai</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('transaksi.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('transaksi.index') }}">
                            <span class="nav-link-icon">
                                <i class="fas fa-receipt"></i>
                            </span>
                            <span class="nav-link-title">Data transaksi</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item {{ request()->routeIs('dashboard.user') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.user') }}">
                            <span class="nav-link-icon">
                                <i class="fas fa-home"></i>
                            </span>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('biodata') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('biodata') }}">
                            <span class="nav-link-icon">
                                <i class="fas fa-user-circle"></i>
                            </span>
                            <span class="nav-link-title">Biodata</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-between px-3 py-2 {{ request()->routeIs('jadwal-user', 'nilai-peserta') ? 'active bg-gradient-primary text-white rounded' : 'text-dark' }}"
                            href="#navbar-jadwal" data-bs-toggle="collapse" role="button"
                            aria-expanded="{{ request()->routeIs('jadwal-user', 'nilai-peserta') ? 'true' : 'false' }}"
                            aria-controls="navbar-jadwal">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <span>Jadwal & Nilai Peserta</span>
                            </div>
                            <i
                                class="fas fa-chevron-down small ms-2 rotate-icon {{ request()->routeIs('jadwal-user', 'nilai-peserta') ? 'rotate' : '' }}"></i>
                        </a>
                        <div class="collapse {{ request()->routeIs('jadwal-user', 'nilai-peserta') ? 'show' : '' }}"
                            id="navbar-jadwal">
                            <ul class="nav flex-column ms-3 border-start border-2 ps-2 mt-2">
                                <li class="nav-item mb-1">
                                    <a class="nav-link {{ request()->routeIs('jadwal-user') ? 'text-primary fw-semibold' : 'text-muted' }}"
                                        href="{{ route('jadwal-user') }}">
                                        <i class="fas fa-clock me-2"></i> Jadwal Tes TOEFL
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('nilai-peserta-user') ? 'text-primary fw-semibold' : 'text-muted' }}"
                                        href="{{ route('nilai-peserta-user') }}">
                                        <i class="fas fa-file-alt me-2"></i> Nilai Peserta
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ request()->routeIs('bantuan') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('bantuan') }}">
                            <span class="nav-link-icon">
                                <i class="fas fa-question-circle"></i>
                            </span>
                            <span class="nav-link-title">Bantuan</span>
                        </a>
                    </li>
                @endif
            </ul>

            <div class="logout-section">
                <button class="btn-logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </button>
            </div>
        </div>
    </div>
</aside>

<script>
    function toggleSlide(id) {
        const el = document.getElementById(id);
        el.classList.toggle('show');
    }

    // Optional: auto expand if active
    document.addEventListener("DOMContentLoaded", function () {
        const el = document.getElementById('jadwalDropdown');
        if (el.querySelector('.active')) {
            el.style.maxHeight = el.scrollHeight + "px";
        }
    });
</script>

<style>
    .slide-menu {
        overflow: hidden;
        transition: max-height 0.3s ease;
        max-height: 0;
    }

    .slide-menu.show {
        max-height: 300px;
        /* atau sesuai kebutuhan */
    }
</style>