<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'riwayat_nilai';
    
    protected $fillable = [
        'id_riwayat',
        'tanggal_test',
        'listening',
        'structure',
        'reading',
        'total_nilai',
    ];
}
