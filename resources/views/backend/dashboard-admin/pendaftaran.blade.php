<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Admin Dashboard</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/css-dashboard/tabler.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-flags.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-payments.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-vendors.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/demo.min.css?1692870487') }}" rel="stylesheet"/>
  </head>
  <body>
    <div class="page">
      <!-- Sidebar -->
      @include('backend.sidebar')
      <!-- Main Content -->
      <div class="page-wrapper">
        <div class="container-xl">
          @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
          <div class="page-header d-print-none">
            <h2 class="page-title">Daftar Pendaftar</h2>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tabel Pendaftar</h3>
            </div>
            <div class="card-body">
              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pengguna</th>
                      <th>Jadwal Ujian</th>
                      <th>Status Pendaftaran</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pendaftaran as $daftar)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $daftar['user']['name'] ?? 'Nama tidak tersedia' }}</td>
                      <td>{{ $daftar['jadwal']['tanggal'] ?? 'Tanggal tidak tersedia' }}</td>
                      <td>{{ $daftar['status_pendaftaran'] }}</td>
                      <td>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#verifikasiModal-{{ $daftar['id_pendaftaran'] }}">
                          Verifikasi
                        </button>
                      </td>
                    </tr>
                    <!-- Modal Verifikasi -->
                    <div class="modal fade" id="verifikasiModal-{{ $daftar['id_pendaftaran'] }}" tabindex="-1" aria-labelledby="verifikasiModalLabel-{{ $daftar['id_pendaftaran'] }}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="verifikasiModalLabel-{{ $daftar['id_pendaftaran'] }}">Verifikasi Pendaftaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('pendaftaran.verifikasi', $daftar['id_pendaftaran']) }}" method="POST">
                              @csrf
                              <div class="mb-3">
                                <label for="status_pendaftaran-{{ $daftar['id_pendaftaran'] }}" class="form-label">Status Verifikasi</label>
                                <select class="form-select" id="status_pendaftaran-{{ $daftar['id_pendaftaran'] }}" name="status_pendaftaran" required>
                                  <option value="Diterima">Diterima</option>
                                  <option value="Ditolak">Ditolak</option>
                                </select>
                              </div>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
    <!-- JavaScript -->
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
