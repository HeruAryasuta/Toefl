<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\NilaiExport;
use Maatwebsite\Excel\Facades\Excel;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;
use Illuminate\Support\Facades\Response;
use App\Models\Nilai;

class JadwalUserController extends Controller
{
    public function index()
    {
        // Query untuk mengambil data
        $data = DB::table('pendaftaran')
            ->join('users', 'pendaftaran.id_users', '=', 'users.id_users')
            ->join('jadwal_test', 'pendaftaran.id_jadwal', '=', 'jadwal_test.id_jadwal')
            ->leftJoin('riwayat_nilai', 'pendaftaran.id_pendaftaran', '=', 'riwayat_nilai.id_pendaftaran')
            ->select(
                'users.name',
                'users.email',
                'users.nim',
                'users.fakultas',
                'users.prodi',
                'jadwal_test.tanggal_test',
                'jadwal_test.jam_test',
                'jadwal_test.lokasi',
                'pendaftaran.status_pendaftaran',
                'riwayat_nilai.listening',
                'riwayat_nilai.structure',
                'riwayat_nilai.reading',
                'riwayat_nilai.total_nilai'
            )
            ->get();

        return view('backend.dashboard-user.jadwal-peserta');
    }
    // public function index()
    // {
    //     return view('backend.dashboard-user.JadwalUser', compact('jadwalUser'));
    // }

    public function showJadwalPeserta()
    {
        $daftars = Pendaftar::where('id_users', auth()->id())
            ->whereHas('jadwal', function ($query) {
                $query->where('tanggal_test', '>=', now());
            })
            ->get();

        $nilaiList = Nilai::whereHas('pendaftaran', function ($query) {
            $query->where('id_users', auth()->id());
        })
            ->orderBy('tanggal_test', 'desc')
            ->get();

        return view('backend.dashboard-user.jadwal-peserta', compact('daftars', 'nilaiList'));
    }

    public function printScore(Request $request)
    {
        $tanggal_test = $request->input('tanggal_test');
        $format = $request->input('format');

        \Log::info('Tanggal test yang dipilih:', [$tanggal_test]);

        $nilai = Nilai::whereHas('pendaftaran', function ($query) {
            $query->where('id_users', auth()->id());
        })
            ->where('tanggal_test', $tanggal_test)
            ->get();

        if ($nilai->isEmpty()) {
            \Log::warning("Tidak ada data nilai untuk tanggal: $tanggal_test");
            return back()->with('error', 'Tidak ada data nilai untuk tanggal yang dipilih.');
        }

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('backend.dashboard-user.nilai', compact('nilai', 'tanggal_test'))
                ->setPaper('A4', 'portrait');
            return $pdf->stream("Nilai_TOEFL_$tanggal_test.pdf");
        } elseif ($format === 'excel') {
            return Excel::download(new NilaiExport($tanggal_test), "Nilai_TOEFL_$tanggal_test.xlsx");
        }

        return back()->with('error', 'Format tidak valid.');
    }

    public function tanggalTestUser()
    {
        $testDates = Nilai::whereHas('pendaftaran', function ($query) {
            $query->where('id_users', auth()->id());
        })
            ->pluck('tanggal_test')
            ->unique()
            ->sortDesc()
            ->values();

        \Log::info('Tanggal test user:', $testDates->toArray());

        return response()->json($testDates);
    }

    public function generateCertificate(Request $request)
    {
        // Validasi input
        $request->validate([
            'test_date' => 'required|date',
        ]);

        // Ambil data nilai peserta berdasarkan tanggal test dan user login
        $nilai = Nilai::whereHas('pendaftaran', function ($query) {
            $query->where('id_users', auth()->id());
        })
            ->whereRaw('DATE(tanggal_test) = ?', [$request->input('test_date')])
            ->where('total_nilai', '>=', 450)
            ->first();

        if (!$nilai) {
            return back()->with('error', 'Anda tidak memenuhi syarat untuk mencetak sertifikat.');
        }

        // Nama peserta dari database
        $userName = strtoupper($nilai->pendaftaran?->user?->name ?? 'Peserta Tidak Diketahui');


        // Lokasi file sertifikat template
        $templatePath = public_path('assets/setifikat.pdf');

        // Buat objek FPDI
        $pdf = new Fpdi();
        $pdf->AddPage('L', 'A4');
        $pdf->setSourceFile($templatePath);
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);

        // Tambahkan teks nama peserta
        $pdf->SetFont('Arial', 'B', 24);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(10, 80); // Sesuaikan posisi teks
        $pdf->Cell(0, 10, $userName, 0, 1, 'C');

        // Simpan file PDF sementara
        $outputPath = storage_path("app/public/Sertifikat_{$userName}.pdf");
        $pdf->Output($outputPath, 'F');

        // Unduh file sertifikat
        return Response::download($outputPath, "Sertifikat_TOEFL_{$userName}.pdf");
    }
}
