<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;

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
        return view('backend.dashboard-admin.dashboard-admin', compact('totalUsers', 'transaksiCount'));  // Mengarahkan ke view 'dashboard.blade.php'
    }
}
