<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use DB;

class JadwalUserController extends Controller
{
    public function index()
    {
        // Query untuk mengambil data
        $data = DB::table('pendaftaran')
            ->join('users', 'pendaftaran.id_users', '=', 'users.id_users')
            ->join('jadwal_test', 'pendaftaran.id_jadwal', '=', 'jadwal_test.id_jadwal')
            ->leftJoin('riwayat_nilai', 'pendaftaran.id_pendaftaran', '=', 'riwayat_nilai.id_pendaftaran')
            ->select(
                'users.name',
                'users.email',
                'users.nim',
                'users.fakultas',
                'users.prodi',
                'jadwal_test.tanggal_test',
                'jadwal_test.jam_test',
                'jadwal_test.lokasi',
                'pendaftaran.status_pendaftaran',
                'riwayat_nilai.listening',
                'riwayat_nilai.structure',
                'riwayat_nilai.reading',
                'riwayat_nilai.total_nilai'
            )
            ->get();

        return view('backend.dashboard-user.jadwal-peserta');
    }
    // public function index()
    // {
    //     return view('backend.dashboard-user.JadwalUser', compact('jadwalUser'));
    // }

    public function showJadwalPeserta()
    {
    $daftars = Pendaftar::where('id_users', auth()->id())->get(); 

    return view('backend.dashboard-user.jadwal-peserta', compact('daftars'));
    }
}
