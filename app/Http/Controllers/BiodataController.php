<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        return view('backend.dashboard-user.biodata', compact('users'));
    }

    public function update(Request $request, $id_users)
    {
        $users = User::findOrFail($id_users);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id_users . ',id_users',
            'nim' => 'required|string|max:20',
            'fakultas' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'prodi' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Jika ada file yang diunggah, simpan dan hapus file lama
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($users->foto && file_exists(public_path('storage/' . $users->foto))) {
                unlink(public_path('storage/' . $users->foto));
            }

            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('profile_pictures', 'public');
            $users->foto = $fotoPath;
        }

        // Update data tanpa menimpa `foto`
        $users->update([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'fakultas' => $request->fakultas,
            'prodi' => $request->prodi,
            'no_hp' => $request->no_hp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        return redirect()->route('biodata')->with('success', 'Peserta berhasil diperbarui.');
    }
}
