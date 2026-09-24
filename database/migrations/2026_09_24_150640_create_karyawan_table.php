<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table): void {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('no_hp')->unique();
            $table->string('posisi_jabatan');
            $table->string('password');
            $table->string('role')->default('karyawan');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
