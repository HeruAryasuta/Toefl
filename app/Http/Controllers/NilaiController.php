<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
    $riwayatNilai = Nilai::with('pendaftaran')
        ->orderBy('tanggal_test', 'desc')
        ->get();

    $pendaftaran = Pendaftar::all(); // Variabel $pendaftaran didefinisikan

    // Kirim kedua variabel ke view
    return view('backend.dashboard-admin.nila-peserta', compact('riwayatNilai', 'pendaftaran'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pendaftaran' => 'required|exists:pendaftaran,id_pendaftaran',
            'tanggal_test' => 'required|date',
            'listening' => 'required|numeric|min:0|max:100',
            'structure' => 'required|numeric|min:0|max:100',
            'reading' => 'required|numeric|min:0|max:100',
        ]);

        try {
            DB::beginTransaction();

            // Calculate total score (average of all sections)
            $totalNilai = ($validated['listening'] + $validated['structure'] + $validated['reading']) / 3;

            Nilai::create([
                'id_pendaftaran' => $validated['id_pendaftaran'],
                'tanggal_test' => $validated['tanggal_test'],
                'listening' => $validated['listening'],
                'structure' => $validated['structure'],
                'reading' => $validated['reading'],
                'total_nilai' => round($totalNilai, 2)
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Nilai TOEFL berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan nilai TOEFL. Silakan coba lagi.');
        }
    }
    

    public function update(Request $request, $id_riwayat)
    {
        $validated = $request->validate([
            'tanggal_test' => 'required|date',
            'listening' => 'required|numeric|min:0|max:100',
            'structure' => 'required|numeric|min:0|max:100',
            'reading' => 'required|numeric|min:0|max:100',
        ]);

        try {
            DB::beginTransaction();

            $riwayatNilai = Nilai::findOrFail($id_riwayat);
            
            // Calculate total score
            $totalNilai = ($validated['listening'] + $validated['structure'] + $validated['reading']) / 3;

            $riwayatNilai->update([
                'tanggal_test' => $validated['tanggal_test'],
                'listening' => $validated['listening'],
                'structure' => $validated['structure'],
                'reading' => $validated['reading'],
                'total_nilai' => round($totalNilai, 2)
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Nilai TOEFL berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui nilai TOEFL. Silakan coba lagi.');
        }
    }

    public function destroy($id_riwayat)
    {
        try {
            $riwayatNilai = Nilai::findOrFail($id_riwayat);
            $riwayatNilai->delete();
            
            return redirect()->back()->with('success', 'Nilai TOEFL berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus nilai TOEFL.');
        }
    }
}
