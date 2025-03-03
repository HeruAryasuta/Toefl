@extends('backend.layouts.app')

@section('content', 'Detail Transaksi')

@section('content')
<div class="container">
    <h3 class="mb-3"><i class="fas fa-info-circle me-2"></i> Detail Transaksi</h3>

    <div class="card">
        <div class="card-body">
            <p><strong>ID Pendaftaran:</strong> {{ $transaksi->id_pendaftaran }}</p>
            <p><strong>Order ID:</strong> {{ $transaksi->order_id }}</p>
            <p><strong>Jumlah:</strong> Rp {{ number_format($transaksi->amount, 0, ',', '.') }}</p>
            <p><strong>Tipe Pembayaran:</strong> {{ ucfirst($transaksi->payment_type) }}</p>
            <p><strong>Status Transaksi:</strong> {{ ucfirst($status->transaction_status) }}</p>
            <p><strong>Waktu Transaksi:</strong> {{ \Carbon\Carbon::parse($transaksi->transaction_time)->format('d M Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
@endsection
