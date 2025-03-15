<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'riwayat_nilai';
    protected $primaryKey = 'id_riwayat';

    protected $fillable = [
        'id_riwayat',
        'id_pendaftaran',
        'tanggal_test',
        'listening',
        'structure',
        'reading',
        'total_nilai',
    ];

    protected $casts = [
        'tanggal_test' => 'date',
        'listening' => 'float',
        'structure' => 'float',
        'reading' => 'float',
        'total_nilai' => 'float'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftar::class, 'id_pendaftaran', 'id_pendaftaran');
    }
}
