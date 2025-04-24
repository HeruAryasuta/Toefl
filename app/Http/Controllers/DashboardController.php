<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalUsers = User::count();
        $transaksiCount = Transaksi::count();

        $jumlahPerbulan = DB::table('pendaftaran')
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('jumlah', 'bulan');

        $labelBulan = array_map(function ($bulan) {
            return date("F", mktime(0, 0, 0, $bulan, 1));
        }, array_keys($jumlahPerbulan->toArray()));

        $nilaiTertinggiPerbulan = DB::table('riwayat_nilai')
            ->selectRaw('MONTH(tanggal_test) as bulan, MAX(total_nilai) as nilai_tertinggi')
            ->groupBy(DB::raw('MONTH(tanggal_test)'))
            ->pluck('nilai_tertinggi', 'bulan');
        $data = [
            'totalUsers' => $totalUsers,
            'transaksiCount' => $transaksiCount,
            'labelBulan' => json_encode(array_values($labelBulan)),
            'jumlahPerbulan' => json_encode(array_values($jumlahPerbulan->toArray())),
            'nilaiTertinggi' => json_encode(array_values($nilaiTertinggiPerbulan->toArray())),
        ];

        return view('backend.dashboard-admin.dashboard-admin', $data);
    }
}
