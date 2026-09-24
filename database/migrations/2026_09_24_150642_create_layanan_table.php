<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan', function (Blueprint $table): void {
            $table->id();
            $table->string('nama_layanan');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_per_kg', 12, 2);
            $table->string('satuan', 20);
            $table->unsignedSmallInteger('estimasi_hari');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'nama_layanan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
