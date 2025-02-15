<?php

namespace App\Http\Controllers;

use App\Models\JadwalTest;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Http\Request;

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
        // Validasi input
        $request->validate([
            'status_pendaftaran' => 'required|in:Diterima,Ditolak',
        ]);

        // Cari pendaftaran berdasarkan ID
        $pendaftaran = Pendaftar::findOrFail($id);

        // Update status pendaftaran
        $pendaftaran->update([
            'status_pendaftaran' => $request->status_pendaftaran,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Pendaftaran berhasil diverifikasi.');
    }
}
