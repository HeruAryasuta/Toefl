@extends('layouts.app')

@section('tittle', 'Pendaftaran Ujian')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

    <body>
        <div class="page">
            @include('backend.sidebar')

            <div class="page-wrapper">
                <div class="container-xl py-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="section-title m-0">Daftar Jadwal Ujian</h2>
                        <a href="{{ route('jadwal-user') }}" class="btn btn-kembali">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                    </div>

                    <div class="card">
                        <div class="card-header text-center">
                            <h5 class="card-title">Jadwal Ujian Tersedia</h5>
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
                                                <td>
                                                    <div class="date-badge">
                                                        <i class="fas fa-calendar-alt"></i>
                                                        <span>{{ \Carbon\Carbon::parse($jadwalItem->tanggal_test)->translatedFormat('j F Y') }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="time-badge">
                                                        <i class="fas fa-clock"></i>
                                                        <span>{{ \Carbon\Carbon::createFromFormat('H:i:s', $jadwalItem->jam_test)->format('h:i') }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="location-badge">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        <span>{{ $jadwalItem->lokasi }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="quota-badge">
                                                        <i class="fas fa-users"></i>
                                                        {{ $jadwalItem->kuota }} orang
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    @if($jadwalItem->kuota > 0)
                                                        <button type="button" class="btn btn-daftar pay-button"
                                                            id-user="{{ $id_user }}" data-id="{{ $jadwalItem->id_jadwal }}">
                                                            <i class="fas fa-edit"></i>
                                                            Daftar
                                                        </button>
                                                    @else
                                                        <span class="badge-kuota-habis">
                                                            <i class="fas fa-times-circle"></i>
                                                            Kuota Habis
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">
                                                    <div class="empty-state">
                                                        <i class="fas fa-calendar-times"></i>
                                                        <p>Tidak ada jadwal ujian tersedia saat ini</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div class="text-muted">Total Jadwal: {{ $jadwalTests->count() }}</div>
                            <div>{{ $jadwalTests->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let buttons = document.querySelectorAll(".pay-button");

                buttons.forEach(button => {
                    button.addEventListener("click", function () {
                        let idJadwal = this.getAttribute("data-id");
                        let idUser = this.getAttribute("id-user");

                        fetch(`http://127.0.0.1:8000/api/get-midtrans-token/${idJadwal}/${idUser}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === "success") {
                                    let paymentUrl = data.data.payment_url;

                                    // Buka payment URL di jendela baru
                                    const paymentWindow = window.open(paymentUrl, '_blank');

                                    // Polling untuk mengecek apakah window sudah ditutup
                                    const paymentCheckInterval = setInterval(() => {
                                        if (paymentWindow.closed) {
                                            clearInterval(paymentCheckInterval);

                                            // Setelah ditutup, redirect pengguna ke halaman jadwal
                                            window.location.href = '/jadwal-user';
                                        }
                                    }, 1000);
                                } else {
                                    alert("Gagal mendapatkan URL pembayaran. Silakan coba lagi.");
                                }
                            })
                            .catch(error => {
                                console.error("Error fetching payment URL:", error);
                                alert("Terjadi kesalahan dalam memproses pembayaran.");
                            });
                    });
                });
            });
        </script>
@endsection