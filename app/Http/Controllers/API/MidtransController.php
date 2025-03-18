<?php

namespace App\Http\Controllers\API;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaksi;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MidtransController extends Controller
{
    public function getMidtransToken(Request $request)
    {
        try {
            // Ambil total dan metode pembayaran dari request
            $total = 50000;

            // Setup Midtrans Configuration
            Config::$serverKey = "SB-Mid-server-egh9XsV6w4pE_9pnR5_8l37n";
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Persiapkan parameter untuk Snap Midtrans
            $params = [
                'transaction_details' => [
                    'order_id' => uniqid(),
                    'gross_amount' => $total, // Total yang dibayarkan
                ],
                'customer_details' => [
                    'first_name' => "manusia",
                    'email' => "manusia@gmail.com",
                ],
            ];

            // Dapatkan snap token dari Midtrans
            $snapToken = Snap::getSnapToken($params);
            $paymentResponse = Snap::createTransaction($params);
            Log::info('Midtrans Response: ', (array)$paymentResponse);

            // Ambil URL pembayaran dari respons
            $paymentUrl = $paymentResponse->redirect_url;

            // Buat transaksi di database
            // Simpan transaksi ke database jika diperlukan
            // $transaction = Transaksi::create([
            //     'order_id' => $params['transaction_details']['order_id'],
            //     'payment_url' => $paymentMethod === 'cod' ? null : $paymentUrl,
            //     'status' => $paymentMethod === 'cod' ? 'packed' : 'pending',
            //     'total' => $total,
            //     'payment_method' => $paymentMethod,
            // ]);

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
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
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
