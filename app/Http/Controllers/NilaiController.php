<?php

namespace App\Http\Controllers;

use App\Models\JadwalTest;
use App\Models\Nilai;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\NilaiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class NilaiController extends Controller
{
    public function index()
    {
        $riwayatNilai = Nilai::with('pendaftaran')
            ->orderBy('tanggal_test', 'desc')
            ->get();

        $pendaftaran = Pendaftar::where('status_pendaftaran', 'Diterima')
            ->join('users', 'pendaftaran.id_users', '=', 'users.id_users')
            ->select('pendaftaran.*', 'users.name')
            ->get();
        // dd($pendaftaran);


        return view('backend.dashboard-admin.nila-peserta', compact('riwayatNilai', 'pendaftaran'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pendaftaran' => 'required|exists:pendaftaran,id_pendaftaran',
            'listening' => 'required|numeric|min:31|max:68',
            'structure' => 'required|numeric|min:31|max:68',
            'reading' => 'required|numeric|min:31|max:67',
        ]);

        try {
            DB::beginTransaction();

            $pendaftaran = Pendaftar::with('jadwal')->findOrFail($validated['id_pendaftaran']);

            // Cek apakah jadwal ditemukan
            if (!$pendaftaran->jadwal) {
                return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
            }

            $totalNilai = round(($validated['listening'] + $validated['structure'] + $validated['reading']) * 10 / 3);
            // dd($totalNilai);

            Nilai::create([
                'id_pendaftaran' => $validated['id_pendaftaran'],
                'tanggal_test' => $pendaftaran->jadwal->tanggal_test,
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
            'id_pendaftaran' => 'required|exists:pendaftaran,id_pendaftaran',
            'listening' => 'required|numeric|min:0|max:100',
            'structure' => 'required|numeric|min:0|max:100',
            'reading' => 'required|numeric|min:0|max:100',
        ]);

        try {
            DB::beginTransaction();

            $nilai = Nilai::findOrFail($id_riwayat);
            $pendaftaran = Pendaftar::where('id_pendaftaran', $validated['id_pendaftaran'])->firstOrFail();
            $jadwal = JadwalTest::where('id_jadwal', $pendaftaran->id_jadwal)->firstOrFail();


            $totalNilai = round(($validated['listening'] + $validated['structure'] + $validated['reading']) * 10 / 3);

            $nilai->update([
                'id_pendaftaran' => $validated['id_pendaftaran'],
                'tanggal_test' => $jadwal->tanggal_test,
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

    public function getTanggalTest($id_pendaftaran)
    {
        $pendaftaran = Pendaftar::where('id_pendaftaran', $id_pendaftaran)->firstOrFail();
        $jadwal = JadwalTest::where('id_jadwal', $pendaftaran->id_jadwal)->first();

        return response()->json(['tanggal_test' => $jadwal ? $jadwal->tanggal_test : null]);
    }

}
