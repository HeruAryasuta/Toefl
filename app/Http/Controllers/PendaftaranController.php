<?php

namespace App\Http\Controllers;

use App\Exports\DataPendaftarExport;
use App\Models\JadwalTest;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
            'status_pendaftaran' => 'required|in:Diterima,Ditolak,Pending',
            'status_pembayaran' => 'required|in:Lunas,Menunggu Konfirmasi',
        ]);

        // Cari pendaftaran berdasarkan ID
        $pendaftaran = Pendaftar::findOrFail($id);

        // Update status pendaftaran & status pembayaran
        $pendaftaran->update([
            'status_pendaftaran' => $request->status_pendaftaran,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil diverifikasi.');
    }


    public function exportPendaftar()
    {
        return Excel::download(new DataPendaftarExport, 'data_pendaftar.xlsx');
    }
}
