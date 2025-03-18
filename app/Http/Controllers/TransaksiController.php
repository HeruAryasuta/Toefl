<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::latest()->paginate(10);

        return view('backend.dashboard-admin.transaksi', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $status = $transaksi->transaction_status;

        return view('backend.dashboard-admin.transaksi-show', compact('transaksi', 'status'));
    }
}
