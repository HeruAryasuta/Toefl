<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Admin Dashboard</title>
    <!-- CSS files -->
    <link href="{{asset('assets/css-dashboard/tabler.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-flags.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-payments.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-vendors.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/demo.min.css?1692870487')}}" rel="stylesheet"/>
  </head>
  <body >
    <div class="page">
      <!-- Section Sidebar -->
      @include('backend.sidebar')
      <!-- Konten Utama -->
      <div class="page-wrapper">
        <div class="container-xl">
            <div class="page-header d-print-none">
                <h2 class="page-title">Form Biodata</h2>
            </div>
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Biodata Peserta</h3>
            </div>
            <div class="card-body">
                @if (Auth::check())
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row" class="fw-bold">Nama</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Nim</th>
                            <td>{{ Auth::user()->nim }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Fakultas</th>
                            <td>{{ Auth::user()->fakultas }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Prodi</th>
                            <td>{{ Auth::user()->prodi }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Email</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">No Hp</th>
                            <td>{{ Auth::user()->no_hp }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Foto</th>
                            <td>
                                @if(Auth::user()->foto)
                                <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil" class="img-fluid rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                                @else
                                <img src="{{ asset('assets/default-avatar.png') }}" alt="Foto Profil" class="img-fluid rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                @else
                <p class="text-center">Biodata tidak ditemukan.</p>
                @endif
            </div>
        </div>
        </div>
    </div>
    </div>
    <!-- Libs JS -->
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
    </form>
  </body>
</html>