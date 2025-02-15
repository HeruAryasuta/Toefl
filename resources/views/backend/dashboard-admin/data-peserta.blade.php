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
      <!-- Sidebar Section -->
      @include('backend.sidebar')
      <!-- Main Content -->
      <div class="page-wrapper">
      <div class="container-xl">
        <div class="page-header d-print-none">
          <h2 class="page-title">Daftar Peserta</h2>
        </div>

        <!-- Notifikasi -->
        @if (session('status'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @elseif (session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @elseif ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <!-- Konten Utama -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tabel Peserta</h3>
          </div>
          <div class="card-body">
            <form action="{{ url('data-peserta/import') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="input-group">
                <input type="file" name="import_file" class="form-control" />
                <button type="submit" class="btn btn-primary">Import</button>
              </div>
            </form>
            <div class="table-responsive mt-5">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>NIM</th>
                    <th>Fakultas</th>
                    <th>Prodi</th>
                    <th>No HP</th>
                    <th>Role</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($users as $user)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->nim }}</td>
                      <td>{{ $user->fakultas }}</td>
                      <td>{{ $user->prodi }}</td>
                      <td>{{ $user->no_hp }}</td>
                      <td>{{ ucfirst($user->role) }}</td>
                      <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-{{ $user->id_users }}">Edit</button>
                        <form action="{{ route('data-peserta.destroy', $user->id_users) }}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                        </form>
                      </td>
                    </tr>
                    <!-- Modal Edit (Tetap sama seperti sebelumnya) -->
                  @empty
                    <tr>
                      <td colspan="9" class="text-center">Tidak ada data user.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </body>
</html>