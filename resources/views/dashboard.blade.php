@extends('layouts.app')

@section('content')
<div class="min-vh-100 bg-light">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-white shadow-sm" style="width: 250px; height: 100vh;">
            <div class="p-4 text-center">
                <h4 class="text-warning font-weight-bold">TOEFL UNIMAL</h4>
            </div>
            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a class="nav-link text-dark d-flex align-items-center" href="#">
                        <i class="bi bi-house-fill me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark d-flex align-items-center" href="#">
                        <i class="bi bi-person-fill me-2"></i> Biodata
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark d-flex align-items-center" href="#">
                        <i class="bi bi-bar-chart-fill me-2"></i> Toefl Prediction
                    </a>
                </li>
            </ul>
            <button class="btn btn-primary btn-block mt-4" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </button>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <div class="bg-primary text-white d-flex justify-content-between align-items-center p-5">
                <div>
                    <h1 class="display-4">Selamat Datang</h1>
                    <p class="lead">{{ Auth::user()->name }}</p>
                </div>
                <img src="/images/welcome-illustration.png" alt="Welcome Illustration" style="max-width: 150px;">
            </div>
            <div class="p-5">
                <!-- Additional Content Goes Here -->
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection
