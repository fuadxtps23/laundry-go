<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rating_ulasan', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedTinyInteger('bintang');
            $table->text('ulasan')->nullable();
            $table->timestamps();

            $table->unique('transaksi_id');
            $table->index(['user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rating_ulasan');
    }
};
