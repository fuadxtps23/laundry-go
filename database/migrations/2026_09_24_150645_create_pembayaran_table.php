<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi')->cascadeOnDelete();
            $table->string('metode', 20);
            $table->decimal('jumlah_bayar', 14, 2);
            $table->string('bukti_pembayaran')->nullable();
            $table->dateTime('tanggal_bayar')->nullable();
            $table->string('status', 30)->default('belum_dibayar');
            $table->timestamps();

            $table->unique('transaksi_id');
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
