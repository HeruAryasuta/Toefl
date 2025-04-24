<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;

class NilaiPesertaUserController extends Controller
{
    public function index()
    {
        // Ambil daftar nilai milik user tersebut
        $nilaiList = Nilai::whereHas('pendaftaran', function ($query) {
            $query->where('id_users', auth()->id());
        })
            ->orderBy('tanggal_test', 'desc')
            ->get();

        // Kirim data ke view
        return view('backend.dashboard-user.nilai-peserta-user', compact('nilaiList'));
    }
}
