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
            <h2 class="page-title">Dashboard</h2>
          </div>
          <!-- Cards Section -->
          <div class="row">
          <div class="col-12">
            <div class="card w-100 shadow-lg border-0" style="border-radius: 15px;">
             <div class="card-body d-flex align-items-center justify-content-between p-4">
               <div>
               <h1 class="mb-3" style="font-weight: bold; color: #4A4A4A;">Selamat Datang, {{ Auth::user()->name }}</h1>
                    <p style="color: #6C757D; font-size: 16px;">
                        Kami senang Anda kembali!.
                    </p>
                </div>
              <div>
                <img src="{{ asset('assets/Welcome-cuate.png') }}" alt="Welcome Image" 
                          class="img-fluid" style="max-width: 220px; border-radius: 10px;">
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