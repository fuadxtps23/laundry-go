<?php

use App\Enums\LaundryStatus;
use App\Enums\PaymentStatus;
use App\Models\Admin;
use App\Models\Karyawan;
use App\Models\Layanan;
use App\Models\Transaksi;
use App\Models\User;

it('renders all customer pages for an authenticated customer', function (): void {
    $customer = User::factory()->create();
    $service = Layanan::factory()->create();
    $transaction = Transaksi::factory()->create([
        'user_id' => $customer->id,
        'layanan_id' => $service->id,
        'status_laundry' => LaundryStatus::Selesai,
    ]);
    $paymentTransaction = Transaksi::factory()->create([
        'user_id' => $customer->id,
        'layanan_id' => $service->id,
        'status_pembayaran' => PaymentStatus::BelumDibayar,
    ]);

    $this->actingAs($customer, 'web');
    foreach ([
        '/dashboard',
        '/pesan',
        '/pesanan',
        route('customer.orders.show', $transaction),
        route('customer.payments.show', $paymentTransaction),
        route('customer.reviews.create', $transaction),
        '/profil',
    ] as $url) {
        $this->get($url)->assertOk();
    }
});

it('renders all employee pages for an authenticated employee', function (): void {
    $employee = Karyawan::factory()->create();
    $customer = User::factory()->create();
    $service = Layanan::factory()->create();
    $transaction = Transaksi::factory()->create([
        'user_id' => $customer->id,
        'layanan_id' => $service->id,
        'karyawan_id' => $employee->id,
    ]);

    $this->actingAs($employee, 'karyawan');
    foreach ([
        '/karyawan/dashboard',
        '/karyawan/transaksi',
        route('karyawan.transactions.show', $transaction),
        route('karyawan.transactions.edit', $transaction),
        '/karyawan/pelanggan',
        '/karyawan/pelanggan/create',
        route('karyawan.customers.show', $customer),
        route('karyawan.customers.edit', $customer),
        '/karyawan/layanan',
        '/karyawan/layanan/create',
        route('karyawan.services.show', $service),
        route('karyawan.services.edit', $service),
        '/karyawan/pembayaran',
        '/karyawan/rating',
        '/karyawan/laporan',
        '/karyawan/profil',
    ] as $url) {
        $this->get($url)->assertOk();
    }
});

it('renders all admin pages for an authenticated admin', function (): void {
    $admin = Admin::factory()->create();
    $customer = User::factory()->create();
    $employee = Karyawan::factory()->create();
    $service = Layanan::factory()->create();
    $transaction = Transaksi::factory()->create([
        'user_id' => $customer->id,
        'layanan_id' => $service->id,
        'karyawan_id' => $employee->id,
    ]);

    $this->actingAs($admin, 'admin');
    foreach ([
        '/admin/dashboard',
        '/admin/transaksi',
        route('admin.transactions.show', $transaction),
        route('admin.transactions.edit', $transaction),
        '/admin/pelanggan',
        '/admin/pelanggan/create',
        route('admin.customers.show', $customer),
        route('admin.customers.edit', $customer),
        '/admin/layanan',
        '/admin/layanan/create',
        route('admin.services.show', $service),
        route('admin.services.edit', $service),
        '/admin/karyawan',
        '/admin/karyawan/create',
        route('admin.karyawan.show', $employee),
        route('admin.karyawan.edit', $employee),
        '/admin/pembayaran',
        '/admin/rating',
        '/admin/laporan',
        '/admin/profil',
    ] as $url) {
        $this->get($url)->assertOk();
    }
});
