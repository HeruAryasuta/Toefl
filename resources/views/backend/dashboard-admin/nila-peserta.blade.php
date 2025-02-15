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
                <h2 class="page-title">Daftar Nilai Peserta</h2>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Nilai Peserta</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        
                    </div>
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