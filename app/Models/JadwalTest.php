<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTest extends Model
{
    use HasFactory;

    protected $table = 'jadwal_test';
    
    protected $fillable = [
        'id_jadwal',
        'tanggal_test',
        'jam_test',
        'lokasi',
        'kuota',
    ];
}
