<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_sequences', function (Blueprint $table): void {
            $table->id();
            $table->unsignedInteger('last_number')->default(0);
            $table->timestamps();
        });

        DB::table('transaction_sequences')->insert([
            'id' => 1,
            'last_number' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_sequences');
    }
};
