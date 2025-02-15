<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Admin Dashboard</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/css-dashboard/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-flags.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-payments.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css-dashboard/demo.min.css') }}" rel="stylesheet"/>
</head>
<body>
    <div class="page">
        <!-- Sidebar -->
        @include('backend.sidebar')

        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <h2 class="page-title">Daftar Penjadwalan</h2>
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Tabel Jadwal</h3>
                        <button class="btn btn-sm btn-light text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#tambahModal">
                            <i class="bi bi-plus-circle"></i> Tambah Jadwal
                        </button>
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
                                        <th>Tanggal Test</th>
                                        <th>Jam Test</th>
                                        <th>Lokasi</th>
                                        <th>Kuota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwalTests as $jadwal)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_test)->translatedFormat('j F Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($jadwal->jam_test)->format('H:i') }}</td>
                                            <td>{{ $jadwal->lokasi }}</td>
                                            <td>{{ $jadwal->kuota }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-{{ $jadwal->id_jadwal }}">Edit</button>
                                                <form action="{{ route('jadwal.destroy', $jadwal->id_jadwal) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Jadwal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="jam_test" class="form-label">Jam Test</label>
                            <input type="time" class="form-control" id="jam_test" name="jam_test" required>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="kuota" class="form-label">Kuota</label>
                            <input type="text" class="form-control" id="kuota" name="kuota" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="{{ asset('assets/js-dashboard/tabler.min.js') }}"></script>
</body>
</html>
