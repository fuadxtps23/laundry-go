@extends('layouts.auth')

@section('title', 'Daftar')
@section('eyebrow', 'Mulai lebih mudah')
@section('headline', 'Laundry bersih, waktu untuk Anda.')
@section('footer', 'Sudah punya akun? <a class="font-semibold text-brand-600 hover:text-brand-700" href="'.route('login').'">Masuk di sini</a>')

@section('form')
    <div class="mb-7">
        <p class="text-sm font-semibold text-brand-600">Buat akun gratis</p>
        <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Daftar sebagai pelanggan</h2>
        <p class="mt-2 text-sm text-slate-500">Satu akun untuk pesan, pantau, dan bayar laundry.</p>
    </div>
    <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
        @csrf
        <div><label for="nama_lengkap" class="form-label">Nama lengkap</label><input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="form-input" required>@error('nama_lengkap')<p class="form-error">{{ $message }}</p>@enderror</div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label for="username" class="form-label">Username</label><input id="username" name="username" value="{{ old('username') }}" class="form-input" required>@error('username')<p class="form-error">{{ $message }}</p>@enderror</div>
            <div><label for="no_hp" class="form-label">No. HP</label><input id="no_hp" name="no_hp" value="{{ old('no_hp') }}" class="form-input" required>@error('no_hp')<p class="form-error">{{ $message }}</p>@enderror</div>
        </div>
        <div><label for="email" class="form-label">Email</label><input id="email" type="email" name="email" value="{{ old('email') }}" class="form-input" required>@error('email')<p class="form-error">{{ $message }}</p>@enderror</div>
        <div><label for="alamat" class="form-label">Alamat</label><textarea id="alamat" name="alamat" rows="2" class="form-input" required>{{ old('alamat') }}</textarea>@error('alamat')<p class="form-error">{{ $message }}</p>@enderror</div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label for="password" class="form-label">Password</label><input id="password" type="password" name="password" class="form-input" required>@error('password')<p class="form-error">{{ $message }}</p>@enderror</div>
            <div><label for="password_confirmation" class="form-label">Konfirmasi password</label><input id="password_confirmation" type="password" name="password_confirmation" class="form-input" required></div>
        </div>
        <button class="btn-primary mt-2 w-full py-3">Buat akun gratis <span>→</span></button>
    </form>
@endsection
