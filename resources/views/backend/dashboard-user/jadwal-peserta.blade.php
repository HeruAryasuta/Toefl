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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .section-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .empty-state {
            text-align: center;
            color: #999;
            font-style: italic;
        }
    </style>
  </head>
  <body>
    <div class="page">
      <!-- Section Sidebar -->
      @include('backend.sidebar')
      <!-- Konten Utama -->
      <div class="page-wrapper">
        <!-- Menampilkan alert jika ada status -->
      @if(session('status'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('status') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

      @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif
        <div class="container-xl">
            <div class="page-header d-print-none">
                <h2 class="section-title">Daftar Nilai</h2>
            </div>
            <div class="mb-3 d-flex justify-content-md-end">
                <a href="/jadwal-user/pendaftaran" class="btn btn-outline-info">+ Daftar Toefl</a>
            </div>
            <!-- Daftar NIlai -->
            <div class="card mb-3">
            <div class="card-header bg-info text-white text-center" style="--bs-bg-opacity: .5;">
                <h5>Daftar Nilai</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover table-striped text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" rowspan="2" class="align-middle">No</th>
                            <th scope="col" rowspan="2" class="align-middle">Tanggal Test</th>
                            <th scope="col" colspan="4">Nilai Toefl</th>
                        </tr>
                        <tr>
                            <th scope="col">LIST</th>
                            <th scope="col">STR</th>
                            <th scope="col">RDG</th>
                            <th scope="col">SCORE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" class="text-muted">Belum ada data nilai.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Daftar kehadiran -->
        <div class="card mb-3">
            <div class="card-header bg-success text-white text-center" style="--bs-bg-opacity: .5;">
                <h5>Daftar Peserta</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover table-striped text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="align-middle">No</th>
                            <th scope="col" class="align-middle">Nama Peserta</th>
                            <th scope="col" class="align-middle">Tanggal Test</th>
                            <th scope="col" class="align-middle">Status Pendaftaran</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($daftars as $key => $pendaftar)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pendaftar->user->name }}</td> <!-- Ambil nama dari relasi user -->
                            <td>
                                @if($pendaftar->jadwal->tanggal_test)
                                    {{ \Carbon\Carbon::parse($pendaftar->jadwal->tanggal_test)->format('d M Y') }}
                                @else
                                    Tanggal tidak tersedia
                                @endif
                            </td>
                            <td>{{ $pendaftar->status_pendaftaran }}</td>
                        </tr>
                    @endforeach

                    @empty($daftars)
                        <tr>
                            <td colspan="4" class="text-center">Jadwal belum tersedia</td>
                        </tr>
                    @endempty
                    </tbody>
                </table>
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
