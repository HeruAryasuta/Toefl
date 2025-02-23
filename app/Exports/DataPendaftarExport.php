<?php

namespace App\Exports;

use App\Models\Pendaftar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DataPendaftarExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Ambil semua data pendaftar
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pendaftar::with(['user', 'jadwal'])->get();
    }

    /**
     * Tentukan heading (judul kolom di Excel)
     */
    public function headings(): array
    {
        return [
            'ID Pendaftaran',
            'Nama',
            'Jadwal Test',
            'Status Pendaftaran',
            'Status Pembayaran',
        ];
    }

    /**
     * Tentukan data yang diekspor ke dalam setiap kolom
     */
    public function map($pendaftar): array
    {
        return [
            $pendaftar->id_pendaftaran,
            $pendaftar->user->name ?? 'Tidak Ada', // Pastikan ada relasi ke user
            $pendaftar->jadwal->tanggal_test ?? 'Belum Dijadwalkan', // Pastikan ada relasi ke jadwal
            $pendaftar->status_pendaftaran,
            $pendaftar->status_pembayaran,
        ];
    }
}