<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::all();

        return view('backend.dashboard-admin.nila-peserta', compact('nilai'));
    }
}
