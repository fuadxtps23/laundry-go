@extends('layouts.auth')

@section('title', 'Login Admin')
@section('eyebrow', 'Admin portal')
@section('headline', 'Kendali penuh untuk bisnis laundry.')
@section('footer', 'Khusus administrator Laundry Go. <a class="font-semibold text-brand-600" href="'.route('home').'">Kembali ke situs</a>')

@section('form')
    <div class="mb-7"><p class="text-sm font-semibold text-brand-900">Akses admin aman</p><h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Masuk sebagai admin</h2><p class="mt-2 text-sm text-slate-500">Kelola transaksi, karyawan, layanan, dan laporan.</p></div>
    <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5">
        @csrf
        <div><label for="login" class="form-label">Username atau email</label><input id="login" name="login" value="{{ old('login') }}" class="form-input" required autofocus>@error('login')<p class="form-error">{{ $message }}</p>@enderror</div>
        <div><label for="password" class="form-label">Password</label><input id="password" type="password" name="password" class="form-input" required>@error('password')<p class="form-error">{{ $message }}</p>@enderror</div>
        <label class="flex items-center gap-2 text-sm text-slate-600"><input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-brand-900 focus:ring-brand-300"> Ingat saya</label>
        <button class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-brand-900 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-800">Masuk ke panel <span>→</span></button>
    </form>
@endsection
