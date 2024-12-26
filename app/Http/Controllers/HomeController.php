<?php

namespace App\Http\Controllers;

use App\Models\JadwalTest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Ambil semua data dari tabel jadwal_test
        $jadwalTests = JadwalTest::all();
        
        // Kirim data ke view
        return view('frontend.home', compact('jadwalTests'));
    }
}
