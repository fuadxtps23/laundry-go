<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') · Laundry Go</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">
@php
    $isAdmin = ($role ?? 'karyawan') === 'admin';
    $sidebarBackground = $isAdmin ? 'bg-brand-900' : 'bg-brand-500';
    $nav = $isAdmin ? [
        ['Dashboard', 'admin.dashboard', '▦'],
        ['Transaksi', 'admin.transactions.index', '↔'],
        ['Pelanggan', 'admin.customers.index', '♙'],
        ['Layanan', 'admin.services.index', '✦'],
        ['Karyawan', 'admin.karyawan.index', '♟'],
        ['Pembayaran', 'admin.payments.index', '▣'],
        ['Rating & Ulasan', 'admin.reviews.index', '★'],
        ['Laporan', 'admin.reports.index', '▤'],
    ] : [
        ['Dashboard', 'karyawan.dashboard', '▦'],
        ['Transaksi', 'karyawan.transactions.index', '↔'],
        ['Pelanggan', 'karyawan.customers.index', '♙'],
        ['Layanan', 'karyawan.services.index', '✦'],
        ['Pembayaran', 'karyawan.payments.index', '▣'],
        ['Rating & Ulasan', 'karyawan.reviews.index', '★'],
        ['Laporan', 'karyawan.reports.index', '▤'],
    ];
@endphp
<div class="min-h-screen lg:flex">
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full text-white transition-transform lg:static lg:translate-x-0 {{ $sidebarBackground }}">
        <div class="flex h-full flex-col">
            <div class="flex items-center justify-between border-b border-white/10 px-6 py-6">
                <a href="{{ route($isAdmin ? 'admin.dashboard' : 'karyawan.dashboard') }}" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl {{ $isAdmin ? 'bg-brand-500' : 'bg-white/20' }} font-black">LG</span>
                    <span><span class="block text-lg font-extrabold">Laundry<span class="text-brand-300">Go</span></span><span class="block text-[10px] uppercase tracking-[0.2em] text-brand-200/60">{{ $isAdmin ? 'Admin Panel' : 'Karyawan Panel' }}</span></span>
                </a>
                <button id="close-sidebar" class="rounded-lg p-1 text-white/60 hover:bg-white/10 lg:hidden">×</button>
            </div>
            <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-6">
                <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.2em] text-brand-200/50">Menu utama</p>
                @foreach ($nav as [$label, $routeName, $icon])
                    @php $active = request()->routeIs($routeName) || request()->routeIs($routeName.'.*'); @endphp
                    <a href="{{ route($routeName) }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition {{ $active ? 'bg-white/15 text-white shadow-sm' : 'text-brand-100/70 hover:bg-white/10 hover:text-white' }}">
                        <span class="w-5 text-center text-base">{{ $icon }}</span>{{ $label }}
                    </a>
                @endforeach
            </nav>
            <div class="border-t border-white/10 p-4">
                <a href="{{ route($role.'.profile.edit') }}" class="flex items-center gap-3 rounded-xl p-3 hover:bg-white/10">
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-500 text-sm font-bold text-white">{{ strtoupper(substr($staffUser->nama_lengkap ?? 'U', 0, 1)) }}</span>
                    <span class="min-w-0 flex-1"><span class="block truncate text-sm font-semibold">{{ $staffUser->nama_lengkap ?? 'Pengguna' }}</span><span class="block truncate text-xs text-brand-200/60">Lihat profil</span></span>
                </a>
                <form method="POST" action="{{ route($role.'.logout') }}" class="mt-2">@csrf<button class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-brand-100/60 hover:bg-white/10 hover:text-white">↪ <span>Keluar</span></button></form>
            </div>
        </div>
    </aside>
    <div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-slate-950/50 lg:hidden"></div>
    <div class="min-w-0 flex-1">
        <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-slate-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <button id="open-sidebar" class="rounded-xl border border-slate-200 p-2 text-slate-600 lg:hidden">☰</button>
                <div><p class="text-sm font-semibold text-slate-900">@yield('header', 'Dashboard')</p><p class="hidden text-xs text-slate-400 sm:block">Rabu, {{ now()->translatedFormat('d F Y') }}</p></div>
            </div>
            <div class="flex items-center gap-3"><span class="hidden rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 sm:inline-flex">● Sistem aktif</span><span class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-100 text-sm font-bold text-brand-700">{{ strtoupper(substr($staffUser->nama_lengkap ?? 'U', 0, 1)) }}</span></div>
        </header>
        <main class="p-4 sm:p-6 lg:p-8">
            <x-flash />
            @yield('content')
        </main>
    </div>
</div>
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const open = () => { sidebar?.classList.remove('-translate-x-full'); overlay?.classList.remove('hidden'); };
    const close = () => { sidebar?.classList.add('-translate-x-full'); overlay?.classList.add('hidden'); };
    document.getElementById('open-sidebar')?.addEventListener('click', open);
    document.getElementById('close-sidebar')?.addEventListener('click', close);
    overlay?.addEventListener('click', close);
</script>
</body>
</html>
