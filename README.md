# Laundry Go

Aplikasi laundry berbasis **Laravel 13 + MySQL** dengan area Customer, Karyawan, dan Admin. Frontend menggunakan Blade, Tailwind CSS v4, dan Vite.

## Fitur

- Multi-guard authentication: `web` (Customer), `karyawan`, dan `admin`.
- Login terpadu di `/login` dengan deteksi role otomatis; URL lama `/admin/login` dan `/karyawan/login` tetap redirect ke `/login`.
- Role middleware untuk memisahkan URL `/`, `/karyawan/*`, dan `/admin/*`.
- Katalog layanan, pesan laundry, kalkulasi harga otomatis, dan kode transaksi `LG-XXXX`.
- Upload bukti pembayaran ke `storage/app/public/bukti_pembayaran` dengan validasi JPG/JPEG/PNG/PDF maksimal 2 MB.
- Alur status laundry `menunggu → diproses → selesai → diambil` (tidak dapat dibalik).
- Alur pembayaran `belum_dibayar → menunggu_verifikasi → lunas`.
- Verifikasi pembayaran, assign karyawan, CRUD pelanggan/layanan/karyawan, rating, laporan, export CSV, dan export PDF.
- Seeder admin default dan enam layanan awal.

## Kebutuhan

- PHP 8.4.1+ (rekomendasi PHP 8.5)
- Composer
- Node.js + npm
- MySQL 8+

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Atur koneksi database di `.env`, lalu jalankan:

```bash
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

Buka `http://localhost:8000`. Untuk development frontend, gunakan `npm run dev` (atau `composer run dev`).

### Login default

| Role | URL | Username | Password |
| --- | --- | --- | --- |
| Admin | `/login` | `admin` | `admin123` |
| Karyawan | `/login` | dibuat oleh Admin | dibuat oleh Admin |
| Customer | `/login` | daftar mandiri | dibuat saat register |

> Ganti password admin sebelum digunakan di lingkungan production.

## Seed dan Factory

`DatabaseSeeder` membuat admin default, sequence transaksi, dan layanan:

- Cuci Komplit — Rp18.000/kg, 1 hari
- Setrika Saja — Rp9.000/kg, 1 hari
- Cuci Kering Lipat — Rp12.000/kg, 2 hari
- Cuci Sepatu — Rp35.000/pasang, 2 hari
- Cuci Karpet — Rp25.000/m², 3 hari
- Bed Cover & Selimut — Rp40.000/potong, 2 hari

Model memiliki factory untuk seluruh tabel domain. Seeder dapat dijalankan ulang dengan:

```bash
php artisan db:seed
```

## Pengujian

Test suite menggunakan Pest dan database SQLite in-memory:

```bash
php artisan test --compact
```

## Struktur penting

- `app/Models` — model Eloquent dan relasi.
- `app/Enums` — status laundry, pembayaran, dan metode pembayaran.
- `app/Http/Middleware` — middleware role Customer/Karyawan/Admin.
- `app/Http/Controllers/Customer` — area pelanggan.
- `app/Http/Controllers/Staff` — implementasi controller operasional yang dipakai kedua area.
- `app/Http/Controllers/Admin` dan `app/Http/Controllers/Karyawan` — controller per area.
- `app/Http/Requests` — validasi server-side seluruh form utama.
- `resources/views` — layout, komponen, halaman Customer, dan halaman operasional.
- `database/migrations` — schema users, karyawan, admins, layanan, transaksi, pembayaran, rating, dan sequence kode.
