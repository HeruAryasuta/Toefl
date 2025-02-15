<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Admin Dashboard</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/css-dashboard/tabler.min.css?1692870487') }}" rel="stylesheet"/>
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
        <div class="container-xl">
            <div class="page-header d-print-none">
                <h2 class="section-title">Daftar Jadwal Ujian</h2>
            </div>

            <div class="mb-3 d-flex justify-content-md-end">
                <a href="{{ route('jadwal-user') }}" class="btn btn-outline-info">< Kembali</a>
            </div>

            <!-- Daftar Jadwal -->
            <div class="card mb-3">
                <div class="card-header bg-info text-white text-center" style="--bs-bg-opacity: .5;">
                    <h5>Jadwal Ujian</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Test</th>
                                <th>Jam Test</th>
                                <th>Lokasi</th>
                                <th>Kuota</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalTests as $jadwalItem)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwalItem->tanggal_test)->translatedFormat('j F Y') }}</td>
                                    <td>{{ $jadwalItem->jam_test }}</td>
                                    <td>{{ $jadwalItem->lokasi }}</td>
                                    <td>{{ $jadwalItem->kuota }}</td>
                                    <td>
                                        @if($jadwalItem->kuota > 0)
                                            <form action="{{ route('pendaftaran.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_jadwal" value="{{ $jadwalItem->id_jadwal }}">
                                                <input type="hidden" name="tanggal_test" value="{{ $jadwalItem->tanggal_test ? \Carbon\Carbon::parse($jadwalItem->tanggal_test)->format('Y-m-d') : '' }}">
                                                <button type="submit" class="btn btn-primary btn-sm">Daftar</button>
                                            </form>
                                        @else
                                            <span class="badge badge-danger">Kuota Habis</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="card-footer d-flex justify-content-between">
                        <div>Total Baris: {{ $jadwalTests->count() }}</div>
                        {{ $jadwalTests->links() }}
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
