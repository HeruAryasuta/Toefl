<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->enum('status_pendaftaran', ['Pending', 'Diterima', 'Ditolak'])->default('Pending')->after('id_jadwal');
            $table->enum('status_pembayaran', ['Lunas', 'Belum Lunas', 'Menunggu Konfirmasi'])->default('Belum Lunas')->after('status_pendaftaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn('status_pendaftaran');
            $table->dropColumn('status_pembayaran');
        });
    }
};
