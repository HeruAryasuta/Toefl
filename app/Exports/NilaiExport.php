<?php

namespace App\Exports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiExport implements FromCollection, WithHeadings
{
    protected $tanggal_test;

    public function __construct($tanggal_test)
    {
        $this->tanggal_test = $tanggal_test;
    }

    public function collection()
    {
        return Nilai::where('tanggal_test', $this->tanggal_test)
            ->select('tanggal_test', 'listening', 'structure', 'reading', 'total_nilai')
            ->get();
    }

    public function headings(): array
    {
        return ['Tanggal Test', 'Listening', 'Structure', 'Reading', 'Total Nilai'];
    }
}
