@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
<style>
  body {
    font-family: 'Inter', sans-serif;
    background-color: #f5f7fb;
  }

  .card {
    border-radius: 10px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-bottom: 1.5rem;
  }

  .table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.025em;
    color: #64748b;
    background-color: #f8fafc;
  }

  .table td {
    vertical-align: middle;
    padding: 0.75rem 1rem;
    color: #334155;
  }

  .badge-success {
    background-color: #bbf7d0;
    color: #166534;
  }
  .badge-warning {
    background-color: #ffe4a3;
    color: #854d0e;
  }
  .badge-danger {
    background-color: #fecaca;
    color: #991b1b;
  }
</style>

@include('backend.sidebar')
<div class="page-wrapper">
    <div class="container-xl">
    @if (session('success'))
      <div class="alert alert-success" role="alert">
      <div class="d-flex align-items-center">
      <i class="fas fa-check-circle me-2"></i>
      <div>{{ session('success') }}</div>
      </div>
      </div>
    @endif
    <div class="page-header d-print-none mb-3">
    <div class="row align-items-center">
        <div class="col">
        <h2 class="page-title">Data Transaksi</h2>
        <div class="text-muted mt-1">
          <i class="far fa-calendar-alt me-1"></i> {{ now()->translatedFormat('l, d F Y') }}
        </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
        <i class="fas fa-handshake me-2 text-primary"></i>
        Transaksi
    </h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-vcenter table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Id Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Tipe Pembayaran</th>
                <th>Jumlah</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transaksi as $trx)
              <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $trx['pendaftaran']['user']['name'] ?? 'Nama tidak tersedia' }}</td>
              <td>{{ $trx->order_id }}</td>
              <td>{{ \Carbon\Carbon::parse($trx->transaction_time)->locale('id')->isoFormat('dddd, D MMMM Y') }}</td>
              <td>{{ ucfirst($trx->payment_type) }}</td>
              <td>Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
              <td>
                  <a href="{{ route('transaksi.show', $trx->id) }}" class="btn btn-primary btn-sm">Detail</a>
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

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
@endsection
