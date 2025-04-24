@extends('layouts.app')

@section('content')

    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
    <div class="container">
        <div class="card shadow-sm border-0 rounded-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i> Detail Transaksi</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="30%">ID Pendaftaran</th>
                            <td>{{ $transaksi->id_pendaftaran }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pendaftar</th>
                            <td>{{ $transaksi['pendaftaran']['user']['name'] ?? 'Nama tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th>Order ID</th>
                            <td>{{ $transaksi->order_id }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>Rp {{ number_format($transaksi->amount, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Tipe Pembayaran</th>
                            <td>{{ ucfirst($transaksi->payment_type) }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Transaksi</th>
                            <td>{{ \Carbon\Carbon::parse($transaksi->transaction_time)->format('d M Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="no-print" style="text-align: center; margin: 20px;">
            <button onclick="window.print()"
                style="padding: 10px 20px; background: #1e40af; color: white; border: none; border-radius: 4px; cursor: pointer;">
                <i class="fas fa-print"></i> Cetak Kartu
            </button>
        </div>

        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
@endsection