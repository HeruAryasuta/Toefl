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
            $table->id('id_riwayat'); // Primary key
            $table->unsignedBigInteger('id_pendaftaran'); // Foreign key to pendaftaran
            $table->date('tanggal_test'); // Date of test
            $table->float('listening', 8, 2); // Listening score
            $table->float('structure', 8, 2); // Structure score
            $table->float('reading', 8, 2); // Reading score
            $table->float('total_nilai', 8, 2); // Total score
            $table->timestamps(); // Created_at and updated_at
        
            // Foreign key constraint
            $table->foreign('id_pendaftaran')
                ->references('id_pendaftaran')
                ->on('pendaftaran')
                ->onDelete('cascade');
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
