<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Masuk') · Laundry Go</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100">
    <div class="grid min-h-screen lg:grid-cols-2">
        <div class="relative hidden overflow-hidden bg-brand-900 p-12 text-white lg:flex lg:flex-col lg:justify-between">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-full bg-brand-500/20 blur-3xl"></div>
            <div class="absolute -bottom-32 -left-20 h-96 w-96 rounded-full bg-orange-300/10 blur-3xl"></div>
            <a href="{{ route('home') }}" class="relative flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-500 text-lg font-black">LG</span>
                <span class="text-xl font-extrabold">Laundry<span class="text-brand-300">Go</span></span>
            </a>
            <div class="relative max-w-lg">
                <p class="mb-4 text-sm font-semibold uppercase tracking-[0.25em] text-brand-300">@yield('eyebrow', 'Laundry tanpa ribet')</p>
                <h1 class="text-4xl font-bold leading-tight tracking-tight">@yield('headline', 'Washing your day, one load at a time.')</h1>
                <p class="mt-5 max-w-md text-base leading-7 text-brand-100/80">Kelola laundry harian dengan mudah. Pesan, pantau progres, dan bayar dalam beberapa klik.</p>
            </div>
            <div class="relative flex items-center gap-3 text-sm text-brand-100/70">
                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10">✦</span>
                <span>Dipercaya oleh pelanggan laundry modern</span>
            </div>
        </div>
        <div class="flex items-center justify-center px-5 py-10 sm:px-10">
            <div class="w-full max-w-md">
                <a href="{{ route('home') }}" class="mb-10 flex items-center gap-3 lg:hidden">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500 font-black text-white">LG</span>
                    <span class="text-lg font-extrabold text-brand-900">Laundry<span class="text-brand-500">Go</span></span>
                </a>
                <div class="card p-6 sm:p-8">
                    <x-flash />
                    @yield('form')
                </div>
                <p class="mt-6 text-center text-xs text-slate-400">@yield('footer')</p>
            </div>
        </div>
    </div>
</body>
</html>
