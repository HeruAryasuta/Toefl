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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id('id_pendaftaran'); // Primary key
            $table->unsignedBigInteger('id_users'); // Foreign key to users
            $table->unsignedBigInteger('id_jadwal'); // Foreign key to jadwal_test
            $table->string('status_pendaftaran')->default('pending'); //  $table->enum('role', ['admin', 'user'])->default('user');Status (e.g., pending, approved, rejected)
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal_test')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
