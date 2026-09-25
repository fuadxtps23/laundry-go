@extends('layouts.auth')

@section('title', 'Masuk')
@section('eyebrow', 'Selamat datang kembali')
@section('headline', 'Cuci 😌, kami yang handalkan.')
@section('footer')
    Belum punya akun?
    <a class="font-semibold text-brand-600 hover:text-brand-700" href="{{ route('register') }}">Daftar Sekarang</a>
@endsection

@section('form')
    <div class="mb-7">
        <p class="text-sm font-semibold text-brand-600">Laundry Go</p>
        <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Masuk ke Laundry Go</h2>
        <p class="mt-2 text-sm text-slate-500">Gunakan username atau email yang terdaftar.</p>
    </div>
    <form method="POST" action="{{ route('login.post') }}" autocomplete="on" class="space-y-5">
        @csrf
        <div>
            <label for="login" class="form-label">Username atau Email</label>
            <input type="text" id="login" name="login" autocomplete="username" placeholder="Username atau email" value="{{ old('login') }}" class="form-input" required autofocus>
            @error('login')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <div class="flex items-center justify-between"><label for="password" class="form-label">Password</label><span class="text-xs text-slate-400">Minimal 8 karakter</span></div>
            <input id="password" type="password" name="password" autocomplete="current-password" placeholder="Password" class="form-input" required>
            @error('password')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <label class="flex items-center gap-2 text-sm text-slate-600"><input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-brand-500 focus:ring-brand-400"> Ingat saya</label>
        <button class="btn-primary w-full py-3">Masuk <span>→</span></button>
    </form>
@endsection
