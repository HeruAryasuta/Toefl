<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTest extends Model
{
    use HasFactory;

    protected $table = 'jadwal_test';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = [
        'tanggal_test',
        'jam_test',
        'lokasi',
        'kuota',
    ];

    public function pendaftaran()
{
    return $this->hasMany(Pendaftar::class, 'id_jadwal');
}
}
