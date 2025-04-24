<?php

namespace App\Http\Controllers;

use App\Exports\DataPendaftarExport;
use App\Models\JadwalTest;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftar::with(['user', 'jadwal'])->get();

        return view('backend.dashboard-admin.pendaftaran', compact('pendaftaran'));
    }

    public function create()
    {
        // Ambil data users dan jadwal untuk form pendaftaran
        $users = User::all();
        $jadwal = JadwalTest::all();

        return view('pendaftaran.create', compact('users', 'jadwal'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_users' => 'required|exists:users,id_users',
            'id_jadwal' => 'required|exists:jadwal_test,id_jadwal',
            'status_pendaftaran' => 'required|in:Pending,Disetujui,Ditolak',
        ]);

        Pendaftar::create($request->all());

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil ditambahkan');
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status_pendaftaran' => 'required|in:Diterima,Ditolak,Pending',
            'status_pembayaran' => 'required|in:Lunas,Menunggu Konfirmasi',
        ]);

        $pendaftaran = Pendaftar::findOrFail($id);
        $pendaftaran->update([
            'status_pendaftaran' => $request->status_pendaftaran,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        // Kirim WA jika statusnya Diterima dan Lunas
        if ($request->status_pendaftaran === 'Diterima' && $request->status_pembayaran === 'Lunas') {
            $user = $pendaftaran->user;

            if ($user && $user->no_hp) {
                $nomor = preg_replace('/^0/', '62', $user->no_hp); // Convert 08xxx ke 628xxx
                $pesan = "Halo {$user->name},\n\nSelamat! Pendaftaran Anda telah *DITERIMA* dan pembayaran *LUNAS*. Terima kasih telah mendaftar, Silahkan Cek Dashboard Anda Untuk Mencetak Kartu.";

                $response = Http::withOptions([
                    'verify' => false
                ])->withHeaders([
                            'Authorization' => 'vsmSVB42EcXmgh1kkEiU',
                        ])->asForm()->post('https://api.fonnte.com/send', [
                            'target' => $nomor,
                            'message' => $pesan,
                        ]);

                // Optional: Cek response
                if ($response->failed()) {
                    \Log::error('Gagal kirim WA Fonnte: ' . $response->body());
                }
            }
        }

        return redirect()->back()->with('success', 'Pendaftaran berhasil diverifikasi.');
    }

    public function exportPendaftar()
    {
        return Excel::download(new DataPendaftarExport, 'data_pendaftar.xlsx');
    }
}
