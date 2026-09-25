<?php

use App\Enums\LaundryStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Admin;
use App\Models\Karyawan;
use App\Models\Layanan;
use App\Models\Pembayaran;
use App\Models\RatingUlasan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

it('renders the public laundry landing page', function (): void {
    Layanan::factory()->create(['nama_layanan' => 'Cuci Komplit']);

    $this->get('/')
        ->assertOk()
        ->assertSee('LaundryGo')
        ->assertSee('Cuci Komplit');
});

it('renders one neutral login page for all roles', function (): void {
    $this->get('/login')
        ->assertOk()
        ->assertSee('Masuk ke Laundry Go')
        ->assertSee('Gunakan username atau email yang terdaftar.')
        ->assertSee('Daftar Sekarang')
        ->assertSee('href="'.route('register').'"', false)
        ->assertSee('autocomplete="on"', false)
        ->assertSee('name="login"', false)
        ->assertSee('id="login"', false)
        ->assertSee('autocomplete="username"', false)
        ->assertSee('placeholder="Username atau email"', false)
        ->assertSee('autocomplete="current-password"', false)
        ->assertDontSee('&lt;a class="font-semibold text-brand-600', false);

    $this->get('/register')
        ->assertOk()
        ->assertSee('href="'.route('login').'"', false)
        ->assertSee('autocomplete="on"', false)
        ->assertSee('autocomplete="name"', false)
        ->assertSee('autocomplete="username"', false)
        ->assertSee('autocomplete="email"', false)
        ->assertSee('autocomplete="tel"', false)
        ->assertSee('autocomplete="street-address"', false)
        ->assertSee('autocomplete="new-password"', false)
        ->assertDontSee('&lt;a class="font-semibold text-brand-600', false);
});

it('registers and logs in a customer using username credentials', function (): void {
    $this->post('/register', [
        'nama_lengkap' => 'Customer Baru',
        'username' => 'customer_baru',
        'email' => 'customer.baru@example.com',
        'no_hp' => '081298765432',
        'alamat' => 'Jakarta',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertRedirect(route('customer.dashboard'));

    $this->assertAuthenticatedAs(User::where('username', 'customer_baru')->firstOrFail(), 'web');
    $this->post('/logout')->assertRedirect(route('login'));

    $this->post('/login', [
        'username' => 'customer_baru',
        'password' => 'password123',
    ])->assertRedirect(route('customer.dashboard'));
});

it('redirects protected areas to the unified login page', function (): void {
    $customer = User::factory()->create();
    $employee = Karyawan::factory()->create();

    $this->actingAs($customer, 'web')->get('/karyawan/dashboard')->assertRedirect(route('login'));
    $this->actingAs($employee, 'karyawan')->get('/admin/dashboard')->assertRedirect(route('login'));
});

it('redirects legacy staff login URLs to the unified login page', function (): void {
    $this->get('/karyawan/login')->assertRedirect('/login');
    $this->get('/admin/login')->assertRedirect('/login');
});

it('logs each role through the unified login page', function (): void {
    $admin = Admin::factory()->create([
        'username' => 'admin_unified',
        'password' => 'admin123',
    ]);
    $employee = Karyawan::factory()->create([
        'username' => 'karyawan_unified',
        'password' => 'karyawan123',
    ]);
    $customer = User::factory()->create([
        'username' => 'customer_unified',
        'password' => 'customer123',
    ]);

    $this->post('/login', ['login' => $admin->username, 'password' => 'admin123'])
        ->assertRedirect(route('admin.dashboard'));
    $this->assertAuthenticatedAs($admin, 'admin');
    $this->post('/logout')->assertRedirect(route('login'));

    $this->post('/login', ['login' => $employee->username, 'password' => 'karyawan123'])
        ->assertRedirect(route('karyawan.dashboard'));
    $this->assertAuthenticatedAs($employee, 'karyawan');
    $this->post('/logout')->assertRedirect(route('login'));

    $this->post('/login', ['login' => $customer->username, 'password' => 'customer123'])
        ->assertRedirect(route('customer.dashboard'));
    $this->assertAuthenticatedAs($customer, 'web');
});

it('shows the unified login error for invalid credentials', function (): void {
    $this->post('/login', ['login' => 'tidak-ada', 'password' => 'salah'])
        ->assertSessionHasErrors(['login' => 'Username/email atau password salah.']);
});

it('updates a customer profile and password', function (): void {
    $customer = User::factory()->create(['password' => 'password123']);

    $this->actingAs($customer, 'web')
        ->post(route('customer.profile.update'), [
            'nama_lengkap' => 'Customer Updated',
            'username' => $customer->username,
            'email' => $customer->email,
            'no_hp' => $customer->no_hp,
            'alamat' => 'Alamat baru',
        ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

    expect($customer->fresh()->nama_lengkap)->toBe('Customer Updated');

    $this->post(route('customer.profile.password'), [
        'password_lama' => 'password123',
        'password' => 'password456',
        'password_confirmation' => 'password456',
    ])->assertRedirect()->assertSessionHasNoErrors();

    expect(Hash::check('password456', $customer->fresh()->password))->toBeTrue();
});

it('keeps simultaneous staff sessions isolated by route guard', function (): void {
    $admin = Admin::factory()->create();
    $employee = Karyawan::factory()->create();

    $this->actingAs($admin, 'admin');
    $this->actingAs($employee, 'karyawan');

    $this->get('/admin/dashboard')->assertOk()->assertSee($admin->nama_lengkap);
    $this->get('/karyawan/dashboard')->assertOk()->assertSee($employee->nama_lengkap);
});

it('creates a customer order with a generated code and calculated total', function (): void {
    $customer = User::factory()->create();
    $service = Layanan::factory()->create(['harga_per_kg' => 18000, 'satuan' => 'kg', 'estimasi_hari' => 1]);

    $response = $this->actingAs($customer, 'web')->post('/pesan', [
        'layanan_id' => $service->id,
        'berat' => 2.5,
        'tanggal_masuk' => now()->format('Y-m-d'),
        'catatan' => 'Pakaian warna gelap',
    ]);

    $transaction = Transaksi::query()->firstOrFail();
    $response->assertRedirect(route('customer.orders.show', $transaction));
    expect($transaction->kode_transaksi)->toMatch('/^LG-\d{4}$/');
    expect((float) $transaction->total_harga)->toBe(45000.0);
    expect($transaction->status_laundry)->toBe(LaundryStatus::Menunggu);
    expect($transaction->status_pembayaran)->toBe(PaymentStatus::BelumDibayar);
});

it('accepts a direct payment without a proof file', function (): void {
    $customer = User::factory()->create();
    $transaction = Transaksi::factory()->create([
        'user_id' => $customer->id,
        'status_pembayaran' => PaymentStatus::BelumDibayar,
    ]);

    $this->actingAs($customer, 'web')->post(route('customer.payments.store', $transaction), [
        'metode' => PaymentMethod::Direct->value,
        'jumlah_bayar' => $transaction->total_harga,
    ])->assertRedirect(route('customer.orders.show', $transaction));

    expect($transaction->fresh()->status_pembayaran)->toBe(PaymentStatus::MenungguVerifikasi);
    expect($transaction->fresh()->payment->bukti_pembayaran)->toBeNull();
});

it('accepts a QRIS proof and moves the transaction to verification', function (): void {
    Storage::fake('public');
    $customer = User::factory()->create();
    $transaction = Transaksi::factory()->create([
        'user_id' => $customer->id,
        'status_pembayaran' => PaymentStatus::BelumDibayar,
    ]);

    $this->actingAs($customer, 'web')->post(route('customer.payments.store', $transaction), [
        'metode' => PaymentMethod::Qris->value,
        'jumlah_bayar' => $transaction->total_harga,
        'bukti_pembayaran' => UploadedFile::fake()->image('bukti.png'),
    ])->assertRedirect(route('customer.orders.show', $transaction));

    expect($transaction->fresh()->status_pembayaran)->toBe(PaymentStatus::MenungguVerifikasi);
    expect($transaction->fresh()->payment->bukti_pembayaran)->not->toBeNull();
});

it('verifies a pending payment and updates the transaction status', function (): void {
    $employee = Karyawan::factory()->create();
    $payment = Pembayaran::factory()->create([
        'status' => PaymentStatus::MenungguVerifikasi,
    ]);

    $this->actingAs($employee, 'karyawan')
        ->post(route('karyawan.payments.verify', $payment))
        ->assertRedirect()
        ->assertSessionHas('success', 'Pembayaran berhasil diverifikasi.');

    expect($payment->fresh()->status)->toBe(PaymentStatus::Lunas);
    expect($payment->fresh()->transaction->status_pembayaran)->toBe(PaymentStatus::Lunas);
});

it('only advances laundry status by one step', function (): void {
    $employee = Karyawan::factory()->create();
    $transaction = Transaksi::factory()->create(['status_laundry' => LaundryStatus::Menunggu]);

    $this->actingAs($employee, 'karyawan')
        ->post(route('karyawan.transactions.status', $transaction), ['status_laundry' => LaundryStatus::Selesai->value])
        ->assertRedirect();

    expect($transaction->fresh()->status_laundry)->toBe(LaundryStatus::Menunggu);

    $this->actingAs($employee, 'karyawan')
        ->post(route('karyawan.transactions.status', $transaction), ['status_laundry' => LaundryStatus::Diproses->value]);

    expect($transaction->fresh()->status_laundry)->toBe(LaundryStatus::Diproses);
});

it('allows a customer to review a completed transaction once', function (): void {
    $customer = User::factory()->create(['poin' => 0]);
    $transaction = Transaksi::factory()->create([
        'user_id' => $customer->id,
        'status_laundry' => LaundryStatus::Selesai,
    ]);

    $this->actingAs($customer, 'web')->post(route('customer.reviews.store', $transaction), [
        'bintang' => 5,
        'ulasan' => 'Hasilnya sangat bersih.',
    ])->assertRedirect(route('customer.orders.show', $transaction));

    expect(RatingUlasan::query()->where('transaksi_id', $transaction->id)->exists())->toBeTrue();
    expect($customer->fresh()->poin)->toBe(100);
});

it('updates a staff profile and password through the correct guard', function (): void {
    $employee = Karyawan::factory()->create([
        'nama_lengkap' => 'Budi Operasional',
        'password' => 'password123',
    ]);

    $this->actingAs($employee, 'karyawan')
        ->post(route('karyawan.profile.update'), [
            'nama_lengkap' => 'Budi Updated',
            'username' => $employee->username,
            'email' => $employee->email,
            'no_hp' => $employee->no_hp,
            'posisi_jabatan' => 'Supervisor',
        ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

    expect($employee->fresh()->nama_lengkap)->toBe('Budi Updated');

    $this->post(route('karyawan.profile.password'), [
        'password_lama' => 'password123',
        'password' => 'password456',
        'password_confirmation' => 'password456',
    ])->assertRedirect();

    expect(Hash::check('password456', $employee->fresh()->password))->toBeTrue();
});

it('updates an admin password through the admin guard', function (): void {
    $admin = Admin::factory()->create(['password' => 'password123']);

    $this->actingAs($admin, 'admin')
        ->post(route('admin.profile.password'), [
            'password_lama' => 'password123',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
        ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

    expect(Hash::check('admin456', $admin->fresh()->password))->toBeTrue();
});

it('exports a report as a PDF for a staff member', function (): void {
    $employee = Karyawan::factory()->create();

    $this->actingAs($employee, 'karyawan')
        ->get(route('karyawan.reports.export'))
        ->assertOk()
        ->assertHeader('content-type', 'application/pdf');
});

it('renders allowed employee positions and validates the selection', function (): void {
    $admin = Admin::factory()->create();
    $employee = Karyawan::factory()->create([
        'posisi_jabatan' => 'Supervisor',
    ]);

    $this->actingAs($admin, 'admin');

    $this->get(route('admin.karyawan.create'))
        ->assertOk()
        ->assertSee('<select id="posisi_jabatan"', false)
        ->assertSee('value="Operator Cuci"', false)
        ->assertSee('value="Operator Setrika"', false)
        ->assertSee('value="Operator Packing"', false)
        ->assertSee('value="Operator Cuci &amp; Lipat"', false)
        ->assertSee('value="Kurir"', false)
        ->assertSee('value="Kasir"', false)
        ->assertSee('value="Supervisor"', false);

    $editResponse = $this->get(route('admin.karyawan.edit', $employee))->assertOk();
    expect($editResponse->getContent())->toMatch('/<option value="Supervisor"[^>]*selected/');

    $this->post(route('admin.karyawan.store'), [
        'nama_lengkap' => 'Karyawan Valid',
        'username' => 'karyawan_valid',
        'email' => 'karyawan.valid@example.com',
        'no_hp' => '081200000001',
        'posisi_jabatan' => 'Kurir',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertRedirect(route('admin.karyawan.index'));

    $this->post(route('admin.karyawan.store'), [
        'nama_lengkap' => 'Karyawan Invalid',
        'username' => 'karyawan_invalid',
        'email' => 'karyawan.invalid@example.com',
        'no_hp' => '081200000002',
        'posisi_jabatan' => 'Manager',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertSessionHasErrors('posisi_jabatan');

    expect(Karyawan::query()->where('username', 'karyawan_valid')->exists())->toBeTrue();
    expect(Karyawan::query()->where('username', 'karyawan_invalid')->doesntExist())->toBeTrue();
});

it('logs an admin into the admin guard and renders the dashboard', function (): void {
    $admin = Admin::factory()->create([
        'username' => 'admin',
        'password' => 'admin123',
    ]);

    $this->post('/login', ['login' => $admin->email, 'password' => 'admin123'])
        ->assertRedirect(route('admin.dashboard'));

    $this->assertAuthenticatedAs($admin, 'admin');
    $this->get('/admin/dashboard')->assertOk()->assertSee('Ringkasan operasional');
});
