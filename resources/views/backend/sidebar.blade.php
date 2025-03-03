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
                    <li class="nav-item {{ request()->routeIs('jadwal-user') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('jadwal-user') }}">
                            <span class="nav-link-icon">
                                <i class="fas fa-clock"></i>
                            </span>
                            <span class="nav-link-title">Toefl Prediction</span>
                        </a>
                    </li>
                @endif
            </ul>
            
            <div class="logout-section">
                <button class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </button>
            </div>
        </div>
    </div>
</aside>