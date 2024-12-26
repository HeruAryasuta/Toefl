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
        Schema::create('riwayat_nilai', function (Blueprint $table) {
            $table->id('id_riwayat');
            $table->date('tanggal_test');
            $table->float('listening', 5);
            $table->float('structure', 5);
            $table->float('reading', 5);
            $table->float('total_nilai', 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_nilai');
    }
};
