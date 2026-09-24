<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table): void {
            $table->id();
            $table->string('kode_transaksi', 20)->unique();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('layanan_id')->constrained('layanan')->restrictOnDelete();
            $table->decimal('berat', 10, 2);
            $table->decimal('total_harga', 14, 2);
            $table->date('tanggal_masuk');
            $table->date('tanggal_estimasi_selesai');
            $table->text('catatan')->nullable();
            $table->string('status_laundry', 20)->default('menunggu');
            $table->string('status_pembayaran', 30)->default('belum_dibayar');
            $table->foreignId('karyawan_id')->nullable()->constrained('karyawan')->nullOnDelete();
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
            $table->index(['status_laundry', 'tanggal_masuk']);
            $table->index(['status_pembayaran', 'created_at']);
            $table->index('karyawan_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
