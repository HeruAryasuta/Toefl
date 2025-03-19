<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{

    use HasFactory;

    protected $primaryKey = 'id_pendaftaran';

    protected $keyType = 'int';

    public $incrementing = true;
    protected $table = 'pendaftaran';
    
    protected $fillable = [
        'id_pendaftaran',
        'id_users',
        'id_jadwal',
        'status_pendaftaran',
        'status_pembayaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalTest::class, 'id_jadwal', 'id_jadwal');
    }
}
