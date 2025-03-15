<?php

namespace App\Http\Controllers;

use App\Models\JadwalTest;
use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\User;

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
        $jadwalTerbaru = JadwalTest::where('tanggal_test', '>=', now())->get();
        $jadwalCount = JadwalTest::where('tanggal_test', '>=', now())->count();
        $maxJadwal = 10;
        $progress = ($jadwalCount / $maxJadwal) * 100;
        $progress = min($progress, 100);
        $skorTertinggi = Nilai::whereHas('pendaftaran', function ($query) {
            $query->where('id_users', auth()->id());
        })->max('total_nilai') ?? 0;


        return view('backend.dashboard-user.dashboard-user', compact('pendaftaran', 'jadwalCount', 'progress', 'pendaftaranCount', 'jadwalTerbaru', 'skorTertinggi'));
    }

    public function cetakKartu($id)
    {
        $pendaftaran = Pendaftar::with('jadwal')->findOrFail($id);
        return view('backend.dashboard-user.kartu', compact('pendaftaran'));
    }
}
