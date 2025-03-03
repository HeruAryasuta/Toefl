@extends('layouts.app')

@section("title", "Penjadwalan")

@section('content')
    @include('backend.sidebar')
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 1.5rem;
        }

        .table td {
            vertical-align: middle;
        }

        .badge-kuota {
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 0.35em 0.65em;
            border-radius: 6px;
        }
    </style>
    <div class="page">
        <div class="container-xl py-4">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                </div>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">Daftar Pendaftar</h2>
                        <div class="text-muted mt-1">
                            <i class="far fa-calendar-alt me-1"></i> {{ now()->format('l, d F Y') }}
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    Tambah Jadwal
                </button>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-alt me-2 text-primary"></i>
                        Jadwal
                    </h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
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
                                        <td>{{ \Carbon\Carbon::parse($jadwal->jam_test)->format('H:i') }} WIB</td>
                                        <td>{{ $jadwal->lokasi }}</td>
                                        <td><span class="badge-kuota">{{ $jadwal->kuota }} orang</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal-{{ $jadwal->id_jadwal }}">Edit</button>
                                            <form action="{{ route('jadwal.destroy', $jadwal->id_jadwal) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if(count($jadwalTests) == 0)
                        <div class="text-center py-4">
                            <p>Belum ada jadwal test</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="tambahModal" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('jadwal.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Jadwal Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Test</label>
                                <input type="date" class="form-control" name="tanggal" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jam Test</label>
                                <input type="time" class="form-control" name="jam_test" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" class="form-control" name="lokasi" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kuota</label>
                                <input type="number" class="form-control" name="kuota" required>
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

        <!-- Modal Edit -->
        @foreach ($jadwalTests as $jadwal)
                <div class="modal fade" id="editModal-{{ $jadwal->id_jadwal }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('jadwal.update', $jadwal->id_jadwal) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Jadwal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal"
                                            value="{{ \Carbon\Carbon::parse($jadwal->tanggal_test)->format('Y-m-d') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jam Test</label>
                                        <input type="time" class="form-control" name="jam_test"
                                            value="{{ \Carbon\Carbon::parse($jadwal->jam_test)->format('H:i') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Lokasi</label>
                                        <input type="text" class="form-control" name="lokasi" value="{{ $jadwal->lokasi }}"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kuota</label>
                                        <input type="number" class="form-control" name="kuota" value="{{ $jadwal->kuota }}"
                                            required>
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
            </div>
        @endforeach
@endsection