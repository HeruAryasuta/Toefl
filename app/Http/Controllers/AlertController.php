<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;

class AlertController extends Controller
{
    public function updateStatus(Request $request, $id_users)
    {
        $pendaftaran = Pendaftar::findOrFail($id_users);
        $pendaftaran->status_pendaftaran = $request->status_pendaftaran;
        $pendaftaran->status_pembayaran = $request->status_pembayaran;
        $pendaftaran->save();

        session()->flash('success', 'Status pendaftaran berhasil diperbarui!');

        return redirect()->back();
    }
}
