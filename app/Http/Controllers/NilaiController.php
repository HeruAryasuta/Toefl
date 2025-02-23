<?php

namespace App\Http\Controllers;

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

    public function printScore(Request $request)
    {
        $tanggal_test = $request->input('test_date');
        $format = $request->input('format');

        $nilai = Nilai::where('tanggal_test', $tanggal_test)->get();

        if ($nilai->isEmpty()) {
            return back()->with('error', 'Tidak ada data nilai untuk tanggal yang dipilih.');
        }

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('backend.print.nilai', compact('nilai', 'tanggal_test'))
                ->setPaper('A4', 'portrait');
            return $pdf->stream("Nilai_TOEFL_$tanggal_test.pdf");
        } elseif ($format === 'excel') {
            return Excel::download(new NilaiExport($tanggal_test), "Nilai_TOEFL_$tanggal_test.xlsx");
        }

        return back()->with('error', 'Format tidak valid.');
    }

    public function printCertificate(Request $request)
    {
        $tanggal_test = $request->input('test_date');

        $nilai = Nilai::where('tanggal_test', $tanggal_test)
            ->where('total_nilai', '>=', 450)
            ->first();

        if (!$nilai) {
            return back()->with('error', 'Sertifikat hanya dapat dicetak jika nilai minimal 450.');
        }

        $pdf = PDF::loadView('backend.print.sertifikat', compact('nilai'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream("Sertifikat_TOEFL_$tanggal_test.pdf");
    }

    public function getTestDates()
    {
    $dates = Nilai::select('tanggal_test')->distinct()->orderBy('tanggal_test', 'desc')->get();
    return response()->json($dates);
    }

}
