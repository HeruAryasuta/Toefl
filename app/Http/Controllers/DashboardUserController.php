<?php

namespace App\Http\Controllers;

use App\Models\JadwalTest;
use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardUserController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftar::with('jadwal')
            ->where('id_users', auth()->id())
            ->whereHas('jadwal', function ($query) {
                $query->where('tanggal_test', '>=', now());
            })
            ->get();

        $pendaftaranCount = $pendaftaran->count();
        $jadwalCount = JadwalTest::where('tanggal_test', '>=', now())->count();
        $maxJadwal = 10;
        $progress = ($jadwalCount / $maxJadwal) * 100;
        $progress = min($progress, 100);

        $skorTertinggi = Nilai::whereHas('pendaftaran', function ($query) {
            $query->where('id_users', auth()->id());
        })->max('total_nilai') ?? 0;

        // Data nilai tertinggi per bulan
        $nilaiPeserta = DB::table('riwayat_nilai')
            ->join('pendaftaran', 'riwayat_nilai.id_pendaftaran', '=', 'pendaftaran.id_pendaftaran')
            ->select('pendaftaran.id_pendaftaran as peserta_id', 'riwayat_nilai.total_nilai')
            ->orderBy('riwayat_nilai.tanggal_test')
            ->get();

        $labelPeserta = $nilaiPeserta->pluck('peserta_id'); // bisa diganti nama kalau ada
        $nilai = $nilaiPeserta->pluck('total_nilai');


        return view('backend.dashboard-user.dashboard-user', [
            'pendaftaran' => $pendaftaran,
            'jadwalCount' => $jadwalCount,
            'progress' => $progress,
            'pendaftaranCount' => $pendaftaranCount,
            'skorTertinggi' => $skorTertinggi,
            'labelPeserta' => json_encode($labelPeserta),
            'nilai' => json_encode($nilai),
        ]);

    }

    public function cetakKartu($id)
    {
        $pendaftaran = Pendaftar::with('jadwal')->findOrFail($id);
        return view('backend.dashboard-user.kartu', compact('pendaftaran'));
    }
}
