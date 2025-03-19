<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftar;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $casts = [
        'id_pendaftaran' => 'integer', // Benar
        'amount' => 'decimal:2', // Pastikan nilai desimal
        'transaction_time' => 'datetime',
    ];
    

    protected $fillable = [
        'id_pendaftaran',
        'order_id',
        'amount',
        'payment_type',
        'transaction_status',
        'transaction_time',
    ];

    // Relasi ke tabel pendaftaran
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftar::class, 'id_pendaftaran', 'id_pendaftaran');
    }
}