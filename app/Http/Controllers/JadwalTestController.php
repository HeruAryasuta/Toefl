<?php

namespace App\Http\Controllers;

use App\Models\JadwalTest;
use Illuminate\Http\Request;

class JadwalTestController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel jadwal_test
        $jadwalTests = JadwalTest::all();
        
        // Kirim data ke view
        return view('frontend.home', compact('jadwalTests'));
    }
}
