<?php

namespace App\Http\Controllers;

use App\Exports\DataPesertaExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('backend.dashboard-admin.data-peserta', compact('users'));
    }

    public function create()
    {
        return view('backend.dashboard-admin.create-peserta');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'nim' => 'required|string|max:20',
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'role' => 'required|string|in:admin,user',
        ]);

        User::create($request->all());
        return redirect()->route('data-peserta')->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function edit($id_users)
    {
        $users = User::findOrFail($id_users);
        return view('backend.dashboard-admin.edit-peserta', compact('users'));
    }

    public function update(Request $request, $id_users)
    {
        $users = User::findOrFail($id_users);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id_users . ',id_users',
            'nim' => 'required|string|max:20',
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'role' => 'required|string|in:admin,user',
        ]);

        $users->update($request->all());
        return redirect()->route('data-peserta')->with('success', 'Peserta berhasil diperbarui.');
    }

    public function destroy($id_users)
    {
        $users = User::findOrFail($id_users);
        $users->delete();
        return redirect()->route('data-peserta')->with('success', 'Peserta berhasil dihapus.');
    }

    public function importExcelData(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file'
            ]
        ]);

        Excel::import(new UsersImport, $request->file('import_file'));

        return redirect()->back()->with('status', 'Berhasil Import');
    }

    public function export()
    {
        $filename = 'data-peserta.xlsx';
        return Excel::download(new DataPesertaExport, $filename);
    }
}
