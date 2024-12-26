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
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama');
            $table->string('password');
            $table->string('nim', 50)->unique();
            $table->string('fakultas');
            $table->string('prodi');
            $table->string('email')->unique();
            $table->string('no_hp', 15);
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('id_jadwal')->nullable();
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal_test')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
