<?php

namespace App\Http\Controllers\API;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Pendaftar;
use App\Models\Transaksi;
use App\Models\JadwalTest;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MidtransController extends Controller
{
    public function getMidtransToken($jadwal_id,$user_id)
    {
        try {
        
        $jadwalTests = JadwalTest::findOrFail($jadwal_id);

        if ($jadwalTests->kuota <= 0) {
            return response()->json(['status' => 'error', 'message' => 'Kuota Sudah Penuh ']);
        }

        $jadwalTests->decrement('kuota');

        // Simpan Pendaftaran
        $pendaftaran = Pendaftar::create([
            'id_users' => $user_id,
            'id_jadwal' => $jadwal_id,
            'status_pendaftaran' => 'Pending',
            'status_pembayaran' => 'Belum Lunas',
        ]);

        $user = User::findOrFail($user_id);
        
        $jadwalTests = $pendaftaran->jadwal_test;
        $orderId = 'ORDER-' . uniqid();


            // Ambil total dan metode pembayaran dari request
            $amount = 50000;

            // Setup Midtrans Configuration
            Config::$serverKey = "SB-Mid-server-HosxOM6Ys7Cv3_R2rdxpp3nQ";
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Persiapkan parameter untuk Snap Midtrans
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $amount, // Total yang dibayarkan
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
            ];

            // Dapatkan snap token dari Midtrans
            $snapToken = Snap::getSnapToken($params);
            $paymentResponse = Snap::createTransaction($params);
            Log::info('Midtrans Response: ', (array)$paymentResponse);

            // Ambil URL pembayaran dari respons
            $paymentUrl = $paymentResponse->redirect_url;

            $transaction = Transaksi::create([
                'id_pendaftaran' => $pendaftaran->id_pendaftaran,
                'order_id' => $orderId,
                'amount' => $amount,
                'payment_type' => 'midtrans',
                'transaction_status' => 'pending',
                'transaction_time' => now(),
                'payment_url' => $paymentUrl
            ]);

            $pendaftaran = Pendaftar::findOrFail($pendaftaran->id_pendaftaran);
            $pendaftaran->payment_url = $paymentUrl;
            $pendaftaran->save();


            return response()->json([
                'status' => 'success',
                'message' => 'Success create transaction',
                'data' => [
                    'snap_token' => $snapToken,
                    'payment_url' => $paymentUrl,
                    // 'transaction' => $transaction
                ]
            ]);
        } catch (\Exception $e) {
            // Tangkap error dan kirimkan respons error
            Log::error('Error creating transaction: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to create transaction. ' . $e->getMessage()]);
        }
    }

    public function callback(Request $request)
    {
        try {
            // Setup Midtrans Configuration
            \Midtrans\Config::$serverKey = "SB-Mid-server-egh9XsV6w4pE_9pnR5_8l37n";
            \Midtrans\Config::$isProduction = "config('midtrans.is_production')";
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            // Ambil notifikasi dari Midtrans
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $orderId = $notification->order_id;

            // Cari transaksi berdasarkan order_id
            $transaction = Transaksi::where('order_id', $orderId)->first();

            if ($transaction) {
                // Update status transaksi berdasarkan status dari Midtrans
                switch ($transactionStatus) {
                    case 'capture':
                    case 'settlement':
                        $transaction->status = 'packed'; // completed
                        break;
                    case 'pending':
                        $transaction->status = 'pending';
                        break;
                    case 'deny':
                    case 'expire':
                    case 'cancel':
                        $transaction->status = 'cancelled';
                        break;
                }

                $transaction->save();
            }

            return response()->json(['message' => 'Callback received successfully']);
        } catch (\Exception $e) {
            // Tangkap error dan kirimkan respons error
            Log::error('Error processing callback: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to process callback. ' . $e->getMessage()]);
        }
    }
}
