<?php

namespace App\Http\Controllers;

use App\Models\JadwalTest;
use Illuminate\Http\Request;

class JadwalTestController extends Controller
{
    public function index()
    {
    $user = auth()->user();

    // Ambil semua jadwal
    $jadwalTests = JadwalTest::where('tanggal_test', '>=', now())->paginate(10);
    
    if ($user && $user->role === 'admin') {
        return view('backend.dashboard-admin.penjadwalan', compact('jadwalTests'));
    } else {
        return view('frontend.home', compact('jadwalTests'));
    }
    }
    public function create()
    {
        return view('jadwal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam_test' => 'required|date_format:H:i',
            'lokasi' => 'nullable|string|max:255', 
            'kuota' => 'nullable|integer|min:0',  
        ]);

        JadwalTest::create([
            'tanggal_test' => $request->tanggal,
            'jam_test' => $request->jam_test,
            'lokasi' => $request->lokasi ?? 'Belum Ditentukan', 
            'kuota' => $request->kuota ?? 0, 
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jadwal = JadwalTest::findOrFail($id);
        return view('backend.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam_test' => 'required|date_format:H:i',
            'lokasi' => 'nullable|string|max:255', 
            'kuota' => 'nullable|integer|min:0',
        ]);

        $jadwal = JadwalTest::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jadwal = JadwalTest::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
}
