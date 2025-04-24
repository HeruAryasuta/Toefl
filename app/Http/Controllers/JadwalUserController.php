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
use Carbon\Carbon;

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
        $request->validate([
            'test_date' => 'required|date',
        ]);

        $nilai = Nilai::whereHas('pendaftaran', function ($query) {
            $query->where('id_users', auth()->id());
        })
            ->whereRaw('DATE(tanggal_test) = ?', [$request->input('test_date')])
            ->where('total_nilai', '>=', 450)
            ->first();

        if (!$nilai) {
            return back()->with('error', 'Anda tidak memenuhi syarat untuk mencetak sertifikat.');
        }

        $user = $nilai->pendaftaran?->user;

        // Data untuk sertifikat
        $userName = strtoupper($user->name ?? 'Peserta Tidak Diketahui');
        $ttl = strtoupper($user->tempat_lahir . '/' . Carbon::parse($user->tanggal_lahir)->format('d M Y'));
        $listening = $nilai->listening;
        $structure = $nilai->structure;
        $reading = $nilai->reading;
        $total = $nilai->total_nilai;
        $tanggalTest = Carbon::parse($nilai->tanggal_test)->format('d M Y');
        $validThrough = Carbon::parse($nilai->tanggal_test)->addYears(2)->format('d M Y');

        // Lokasi template sertifikat
        $templatePath = public_path('assets/Untitled.pdf');

        // Generate PDF
        $pdf = new Fpdi();
        $pdf->AddPage('L', 'A4');
        $pdf->setSourceFile($templatePath);
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetTextColor(0, 0, 0);

        // Nama Peserta
        $pdf->SetFont('Arial', 'B', 24);
        $pdf->SetXY(10, 75); // Geser ke atas
        $pdf->Cell(0, 10, $userName, 0, 1, 'C');


        // TTL
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetXY(138, 84.5);
        $pdf->Cell(0, 10, "$ttl", 0, 1);

        // Skor
        $pdf->SetXY(150, 114.5);
        $pdf->Cell(0, 10, "$listening", 0, 1);

        $pdf->SetXY(150, 120.5);
        $pdf->Cell(0, 10, "$structure", 0, 1);

        // Skor Reading
        $pdf->SetXY(150, 128);
        $pdf->Cell(0, 10, "$reading", 0, 1);

        // Total Nilai
        $pdf->SetXY(150, 135.5);
        $pdf->Cell(0, 10, "$total", 0, 1);

        // Tanggal Test & Masa Berlaku
        $pdf->SetXY(47, 165);
        $pdf->Cell(0, 10, "$tanggalTest", 0, 1);
        $pdf->SetXY(47, 170);
        $pdf->Cell(0, 10, "$validThrough", 0, 1);

        // Output
        $outputPath = storage_path("app/public/Sertifikat_{$userName}.pdf");
        $pdf->Output($outputPath, 'F');

        return Response::download($outputPath, "Sertifikat_TOEFL_{$userName}.pdf");
    }
}
