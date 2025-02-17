<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
        </button>
        <a href="/" class="navbar-brand navbar-brand-autodark">
            <img src="{{asset('assets/logo_upt.png')}}" alt="Logo" class="navbar-brand-image" />
            <span class="navbar-brand-text font-monospace">UPT</span>
        </a>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav">
                <!-- Sidebar untuk Admin -->
                @if(auth()->user()->role === 'admin')
                    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <img src="{{asset('assets/dashboard-logo.png')}}" alt="">
                            </span>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('data-peserta') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('data-peserta') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <img src="{{asset('assets/task.png')}}" alt="">
                            </span>
                            <span class="nav-link-title">Data Peserta</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('pendaftaran') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pendaftaran') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <img src="{{asset('assets/edit.png')}}" alt="">
                            </span>
                            <span class="nav-link-title">Pendaftaran</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('penjadwalan') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('penjadwalan') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <img src="{{asset('assets/edit.png')}}" alt="">
                            </span>
                            <span class="nav-link-title">Penjadwalan</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('nilai-peserta') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('nilai-peserta') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <img src="{{asset('assets/nilai.png')}}" alt="">
                            </span>
                            <span class="nav-link-title">Data Nilai</span>
                        </a>
                    </li>
                @else
                    <!-- Sidebar untuk User -->
                    <li class="nav-item {{ request()->routeIs('dashboard.user') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.user') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <img src="{{asset('assets/dashboard-logo.png')}}" alt="">
                            </span>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('biodata') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('biodata') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <img src="{{asset('assets/task.png')}}" alt="">
                            </span>
                            <span class="nav-link-title">Biodata</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('jadwal-user') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('jadwal-user') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <img src="{{asset('assets/edit.png')}}" alt="">
                            </span>
                            <span class="nav-link-title">Toefl Prediction</span>
                        </a>
                    </li>
                @endif
            </ul>
            <div class="mt-auto mb-3">
                <button class="btn btn-danger w-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="d-flex align-items-center justify-content-center">
                        <img src="{{asset('assets/logout.png')}}" alt="Logout Icon" class="me-2" style="width: 20px; height: 20px;">
                        Keluar
                    </span>
                </button>
            </div>
        </div>
    </div>
</aside>
