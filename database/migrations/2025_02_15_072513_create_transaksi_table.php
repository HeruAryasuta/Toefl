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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id(); // ID transaksi otomatis
            $table->foreignId('id_pendaftaran')
                ->constrained('pendaftaran', 'id_pendaftaran') // Sesuaikan dengan nama primary key
                ->onDelete('cascade');
            $table->string('order_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('payment_type'); // Misal: credit_card, gopay, bank_transfer
            $table->string('transaction_status'); // pending, success, failed
            $table->timestamp('transaction_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
