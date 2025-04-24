<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\JadwalTest;

class WhatsAppNotificationController extends Controller
{
    public function handlePaymentSuccess($idJadwal, $idUser)
    {
        \Log::info("HANDLE PAYMENT TRIGGERED UNTUK USER: {$idUser}, JADWAL: {$idJadwal}");
        $user = User::where('id_users', $idUser)->firstOrFail();
        $jadwal = JadwalTest::findOrFail($idJadwal);

        $this->sendWhatsAppNotification($user->no_hp, $user->name, $jadwal);
    }

    public function sendWhatsAppNotification($phone, $name, $jadwal)
    {
        $token = 'vsmSVB42EcXmgh1kkEiU';

        $message = "Halo {$name}, pembayaran ujian Anda untuk jadwal {$jadwal->tanggal_test} telah sukses. Silakan cek jadwal Anda di Dashboard.";

        $response = Http::withHeaders([
            'Authorization' => $token
        ])->post('https://api.fonnte.com/send', [
            'target' => $phone,
            'message' => $message,
            'countryCode' => '62',
        ]);

        if ($response->successful()) {
            return true;
        } else {
            \Log::error('Fonnte API error: ' . $response->body());
            return false;
        }
    }
}