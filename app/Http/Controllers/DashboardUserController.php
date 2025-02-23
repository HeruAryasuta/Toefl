<?php

namespace App\Http\Controllers;

use App\Models\JadwalTest;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\User;

class DashboardUserController extends Controller
{
    public function index()
    {

    $pendaftaran = Pendaftar::with('jadwal')->where('id_users', auth()->id())->get();
    $pendaftaranCount = Pendaftar::where('id_users', auth()->id())->count();
    $jadwalCount = JadwalTest::count();
    $maxJadwal = 10; // Target maksimal, bisa disesuaikan
    $progress = ($jadwalCount / $maxJadwal) * 100;
    $progress = min($progress, 100);


    return view('backend.dashboard-user.dashboard-user', compact('pendaftaran', 'jadwalCount', 'progress', 'pendaftaranCount'));
    }

    public function cetakKartu($id)
{
    $pendaftaran = Pendaftar::with('jadwal')->findOrFail($id);
    return view('backend.dashboard-user.kartu', compact('pendaftaran'));
}


    public function dashboardUser()
    {
    $user = auth()->user(); 

    $pendaftaran = Pendaftar::with('jadwal')
        ->where('id_users', $user->id)
        ->get(); 
    
    $jadwalCount = JadwalTest::count(); 

    return view('backend.dashboard-user.index', compact('pendaftaran'));
    }

   
}
