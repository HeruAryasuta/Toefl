<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Jadwal Ujian</title>
    
    <!-- Existing CSS -->
    <link href="{{ asset('assets/css-dashboard/tabler.min.css') }}" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Additional styling -->
    <style>
        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            transition: all 0.3s ease;
        }
        
        .card-header {
            background: linear-gradient(135deg, #0dcaf0 0%, #0d6efd 100%);
            color: white;
            border-bottom: none;
            padding: 1.5rem;
        }
        
        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: #495057;
            font-weight: 600;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        .table tr:hover {
            background-color: #f8f9fa;
            transition: all 0.2s ease;
        }
        
        .btn-daftar {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .btn-daftar:hover {
            background-color: #0b5ed7;
            transform: translateY(-1px);
        }
        
        .btn-kembali {
            border: 2px solid #0dcaf0;
            color: #0dcaf0;
            background: transparent;
            padding: 0.5rem 1.5rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .btn-kembali:hover {
            background-color: #0dcaf0;
            color: white;
        }
        
        .badge-kuota-habis {
            background-color: #dc3545;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-weight: 500;
        }
        
        .card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 1rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="page">
        @include('backend.sidebar')
        
        <div class="page-wrapper">
            <div class="container-xl py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="section-title m-0">Daftar Jadwal Ujian</h2>
                    <a href="{{ route('jadwal-user') }}" class="btn btn-kembali">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>

                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="card-title mb-0">Jadwal Ujian</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th>Tanggal Test</th>
                                        <th>Jam Test</th>
                                        <th>Lokasi</th>
                                        <th class="text-center">Kuota</th>
                                        <th class="text-center" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jadwalTests as $jadwalItem)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($jadwalItem->tanggal_test)->translatedFormat('j F Y') }}</td>
                                            <td>{{ $jadwalItem->jam_test }}</td>
                                            <td>{{ $jadwalItem->lokasi }}</td>
                                            <td class="text-center">{{ $jadwalItem->kuota }}</td>
                                            <td class="text-center">
                                                @if($jadwalItem->kuota > 0)
                                                    <form action="{{ route('pendaftaran.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_jadwal" value="{{ $jadwalItem->id_jadwal }}">
                                                        <input type="hidden" name="tanggal_test" value="{{ $jadwalItem->tanggal_test ? \Carbon\Carbon::parse($jadwalItem->tanggal_test)->format('Y-m-d') : '' }}">
                                                        <button type="submit" class="btn btn-daftar">Daftar</button>
                                                    </form>
                                                @else
                                                    <span class="badge badge-kuota-habis">Kuota Habis</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">
                                                Tidak ada jadwal ujian tersedia
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div>Total Baris: {{ $jadwalTests->count() }}</div>
                        <div>{{ $jadwalTests->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>
</html>