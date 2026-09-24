<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['nama_layanan' => 'Cuci Komplit', 'deskripsi' => 'Cuci, kering, dan setrika untuk pakaian harian.', 'harga_per_kg' => 18000, 'satuan' => 'kg', 'estimasi_hari' => 1],
            ['nama_layanan' => 'Setrika Saja', 'deskripsi' => 'Setrika rapih untuk pakaian yang sudah bersih.', 'harga_per_kg' => 9000, 'satuan' => 'kg', 'estimasi_hari' => 1],
            ['nama_layanan' => 'Cuci Kering Lipat', 'deskripsi' => 'Cuci dan lipat untuk pakaian yang praktis.', 'harga_per_kg' => 12000, 'satuan' => 'kg', 'estimasi_hari' => 2],
            ['nama_layanan' => 'Cuci Sepatu', 'deskripsi' => 'Pembersihan dan pengeringan sepatu.', 'harga_per_kg' => 35000, 'satuan' => 'pasang', 'estimasi_hari' => 2],
            ['nama_layanan' => 'Cuci Karpet', 'deskripsi' => 'Pencucian karpet dengan treatment hygiene.', 'harga_per_kg' => 25000, 'satuan' => 'm2', 'estimasi_hari' => 3],
            ['nama_layanan' => 'Bed Cover & Selimut', 'deskripsi' => 'Pencucian bed cover dan selimut.', 'harga_per_kg' => 40000, 'satuan' => 'potong', 'estimasi_hari' => 2],
        ];

        foreach ($services as $service) {
            Layanan::updateOrCreate(
                ['nama_layanan' => $service['nama_layanan']],
                $service + ['is_active' => true],
            );
        }
    }
}
