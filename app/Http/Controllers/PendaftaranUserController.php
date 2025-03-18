<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\JadwalTest;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use App\Models\Transaksi;

class PendaftaranUserController extends Controller
{
    public function index()
    {
        $jadwalTests = JadwalTest::where('tanggal_test', '>=', now())->paginate(10);
        if ($jadwalTests->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada jadwal yang tersedia.');
        }
        return view('backend.dashboard-user.pendaftaran-user', compact('jadwalTests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_test,id_jadwal'
        ]);

        $jadwalTests = JadwalTest::findOrFail($request->id_jadwal);

        if ($jadwalTests->kuota <= 0) {
            return response()->json(['error' => 'Kuota sudah penuh!'], 400);
        }

        $jadwalTests->decrement('kuota');

        // Simpan Pendaftaran
        $pendaftaran = Pendaftar::create([
            'id_users' => Auth::id(),
            'id_jadwal' => $request->id_jadwal,
            'status_pendaftaran' => 'Pending',
            'status_pembayaran' => 'Belum Lunas',
        ]);

        $user = Auth::user();
        $jadwalTests = $pendaftaran->jadwal_test;
        $orderId = 'ORDER-' . uniqid();
        $amount = 50000; // Harga pendaftaran
        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => $amount,
        ];
        
        $customerDetails = [
            'first_name' => $user->name,
            'email' => $user->email,
        ];

        $payload = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        $snapToken = Snap::getSnapToken($payload);

        // Simpan transaksi
        $transaction = Transaksi::create([
            'id_pendaftaran' => $pendaftaran->id_pendaftaran,
            'order_id' => $orderId,
            'amount' => $amount,
            'payment_type' => 'midtrans',
            'transaction_status' => 'pending',
            'transaction_time' => now(),
        ]);

        // $transaction->snap_token = $snapToken;
        
        // $transaction->save();

        // Kirim Email Konfirmasi
        // Ini kirim email sebelum pembayaran
        // Mail::to($user->email)->send(new SendEmail($user, $jadwal));

        return response()->json(['snap_token' => $snapToken]);
    }
}
