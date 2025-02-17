<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataPesertaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('name', 'nim', 'fakultas', 'prodi', 'no_hp', 'role')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIM',
            'Fakultas',
            'Prodi',
            'No. HP',
            'Role',
        ];
    }
}
