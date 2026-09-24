<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Auth\KaryawanAuthController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\PageController;
use App\Http\Controllers\Customer\PaymentController as CustomerPaymentController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Customer\ReviewController as CustomerReviewController;
use App\Http\Controllers\Karyawan\CustomerController;
use App\Http\Controllers\Karyawan\DashboardController;
use App\Http\Controllers\Karyawan\PaymentController;
use App\Http\Controllers\Karyawan\ProfileController;
use App\Http\Controllers\Karyawan\ReportController;
use App\Http\Controllers\Karyawan\ReviewController;
use App\Http\Controllers\Karyawan\ServiceController;
use App\Http\Controllers\Karyawan\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/beranda', [PageController::class, 'home'])->name('beranda');
Route::get('/layanan', [PageController::class, 'services'])->name('layanan');

Route::middleware('guest:web')->group(function (): void {
    Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'login'])->middleware('throttle:customer-login')->name('login.store');
    Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'register'])->middleware('throttle:registration')->name('register.store');
});

Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');

Route::middleware('customer')->group(function (): void {
    Route::get('/dashboard', CustomerDashboardController::class)->name('customer.dashboard');
    Route::get('/pesan', [OrderController::class, 'create'])->name('customer.orders.create');
    Route::post('/pesan', [OrderController::class, 'store'])->name('customer.orders.store');
    Route::get('/pesanan', [OrderController::class, 'index'])->name('customer.orders.index');
    Route::get('/pesanan/{transaksi}', [OrderController::class, 'show'])->name('customer.orders.show');
    Route::get('/pembayaran/{transaksi}', [CustomerPaymentController::class, 'show'])->name('customer.payments.show');
    Route::post('/pembayaran/{transaksi}', [CustomerPaymentController::class, 'store'])->name('customer.payments.store');
    Route::get('/rating/{transaksi}', [CustomerReviewController::class, 'create'])->name('customer.reviews.create');
    Route::post('/rating/{transaksi}', [CustomerReviewController::class, 'store'])->name('customer.reviews.store');
    Route::get('/profil', [CustomerProfileController::class, 'edit'])->name('customer.profile.edit');
    Route::post('/profil', [CustomerProfileController::class, 'update'])->name('customer.profile.update');
    Route::post('/profil/password', [CustomerProfileController::class, 'updatePassword'])->name('customer.profile.password');
});

Route::prefix('karyawan')->name('karyawan.')->group(function (): void {
    Route::middleware('guest:karyawan')->group(function (): void {
        Route::get('/login', [KaryawanAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [KaryawanAuthController::class, 'login'])->middleware('throttle:karyawan-login')->name('login.store');
    });
    Route::post('/logout', [KaryawanAuthController::class, 'logout'])->name('logout');

    Route::middleware('karyawan')->group(function (): void {
        Route::redirect('/', '/karyawan/dashboard')->name('home');
        Route::get('/dashboard', [DashboardController::class, '__invoke'])->name('dashboard');
        Route::resource('transaksi', TransactionController::class)
            ->except(['create', 'store'])
            ->names('transactions');
        Route::post('transaksi/{transaksi}/status', [TransactionController::class, 'updateStatus'])->name('transactions.status');
        Route::resource('pelanggan', CustomerController::class)
            ->parameters(['pelanggan' => 'user'])
            ->names('customers');
        Route::resource('layanan', ServiceController::class)->names('services');
        Route::get('pembayaran', [PaymentController::class, 'index'])->name('payments.index');
        Route::post('pembayaran/{pembayaran}/verifikasi', [PaymentController::class, 'verify'])->name('payments.verify');
        Route::get('rating', [ReviewController::class, 'index'])->name('reviews.index');
        Route::get('laporan', [ReportController::class, 'index'])->name('reports.index');
        Route::get('laporan/export', [ReportController::class, 'export'])->name('reports.export');
        Route::get('profil', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('profil', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    });
});

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::middleware('guest:admin')->group(function (): void {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->middleware('throttle:admin-login')->name('login.store');
    });
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function (): void {
        Route::redirect('/', '/admin/dashboard')->name('home');
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, '__invoke'])->name('dashboard');
        Route::resource('transaksi', App\Http\Controllers\Admin\TransactionController::class)
            ->except(['create', 'store'])
            ->names('transactions');
        Route::post('transaksi/{transaksi}/status', [App\Http\Controllers\Admin\TransactionController::class, 'updateStatus'])->name('transactions.status');
        Route::post('transaksi/{transaksi}/assign', [App\Http\Controllers\Admin\TransactionController::class, 'assign'])->name('transactions.assign');
        Route::resource('pelanggan', App\Http\Controllers\Admin\CustomerController::class)
            ->parameters(['pelanggan' => 'user'])
            ->names('customers');
        Route::resource('layanan', App\Http\Controllers\Admin\ServiceController::class)->names('services');
        Route::resource('karyawan', EmployeeController::class)->names('karyawan');
        Route::get('pembayaran', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');
        Route::post('pembayaran/{pembayaran}/verifikasi', [App\Http\Controllers\Admin\PaymentController::class, 'verify'])->name('payments.verify');
        Route::get('rating', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
        Route::get('laporan', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
        Route::get('laporan/export', [App\Http\Controllers\Admin\ReportController::class, 'export'])->name('reports.export');
        Route::get('profil', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('profil', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
        Route::post('profil/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password');
    });
});
