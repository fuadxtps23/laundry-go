@extends('layouts.customer')

@section('title', 'Rating & Ulasan')
@section('header', 'Rating & ulasan')

@section('content')
<div class="mb-8"><a href="{{ route('customer.orders.show', $transaksi) }}" class="text-sm font-semibold text-brand-600">← Kembali ke pesanan</a><h1 class="page-title mt-3">Bagaimana laundry Anda?</h1><p class="page-subtitle">Beri rating untuk transaksi <span class="font-semibold text-slate-700">{{ $transaksi->kode_transaksi }}</span>.</p></div>
<form method="POST" action="{{ route('customer.reviews.store', $transaksi) }}" class="max-w-2xl">@csrf<div class="card p-6 sm:p-8"><fieldset><legend class="form-label">Rating layanan</legend><div class="mt-3 flex gap-2" id="star-inputs">@for($star=1;$star<=5;$star++)<label class="cursor-pointer"><input type="radio" name="bintang" value="{{ $star }}" class="peer sr-only" @checked(old('bintang', 5) == $star) required><span class="flex h-12 w-12 items-center justify-center rounded-xl border border-slate-200 text-2xl text-slate-300 transition peer-checked:border-brand-300 peer-checked:bg-brand-50 peer-checked:text-brand-500 hover:bg-brand-50 sm:h-14 sm:w-14">★</span></label>@endfor</div><p class="mt-2 text-xs text-slate-400">1 = kurangpuas, 5 = sangat puas</p>@error('bintang')<p class="form-error">{{ $message }}</p>@enderror</fieldset><div class="mt-7"><label for="ulasan" class="form-label">Ulasan <span class="font-normal text-slate-400">(opsional)</span></label><textarea id="ulasan" name="ulasan" rows="5" class="form-input" placeholder="Ceritakan pengalaman laundry Anda...">{{ old('ulasan') }}</textarea>@error('ulasan')<p class="form-error">{{ $message }}</p>@enderror</div><button class="btn-primary mt-7 w-full py-3 sm:w-auto">Kirim ulasan <span>→</span></button></div></form>
@endsection
