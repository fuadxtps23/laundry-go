<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> · Laundry Go</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-slate-50">
<?php
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
?>
<div class="min-h-screen lg:flex">
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full text-white transition-transform lg:static lg:translate-x-0 <?php echo e($sidebarBackground); ?>">
        <div class="flex h-full flex-col">
            <div class="flex items-center justify-between border-b border-white/10 px-6 py-6">
                <a href="<?php echo e(route($isAdmin ? 'admin.dashboard' : 'karyawan.dashboard')); ?>" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl <?php echo e($isAdmin ? 'bg-brand-500' : 'bg-white/20'); ?> font-black">LG</span>
                    <span><span class="block text-lg font-extrabold">Laundry<span class="text-brand-300">Go</span></span><span class="block text-[10px] uppercase tracking-[0.2em] text-brand-200/60"><?php echo e($isAdmin ? 'Admin Panel' : 'Karyawan Panel'); ?></span></span>
                </a>
                <button id="close-sidebar" class="rounded-lg p-1 text-white/60 hover:bg-white/10 lg:hidden">×</button>
            </div>
            <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-6">
                <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.2em] text-brand-200/50">Menu utama</p>
                <?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $routeName, $icon]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $active = request()->routeIs($routeName) || request()->routeIs($routeName.'.*'); ?>
                    <a href="<?php echo e(route($routeName)); ?>" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition <?php echo e($active ? 'bg-white/15 text-white shadow-sm' : 'text-brand-100/70 hover:bg-white/10 hover:text-white'); ?>">
                        <span class="w-5 text-center text-base"><?php echo e($icon); ?></span><?php echo e($label); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </nav>
            <div class="border-t border-white/10 p-4">
                <a href="<?php echo e(route($role.'.profile.edit')); ?>" class="flex items-center gap-3 rounded-xl p-3 hover:bg-white/10">
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-500 text-sm font-bold text-white"><?php echo e(strtoupper(substr($staffUser->nama_lengkap ?? 'U', 0, 1))); ?></span>
                    <span class="min-w-0 flex-1"><span class="block truncate text-sm font-semibold"><?php echo e($staffUser->nama_lengkap ?? 'Pengguna'); ?></span><span class="block truncate text-xs text-brand-200/60">Lihat profil</span></span>
                </a>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-2"><?php echo csrf_field(); ?><button class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-brand-100/60 hover:bg-white/10 hover:text-white">↪ <span>Keluar</span></button></form>
            </div>
        </div>
    </aside>
    <div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-slate-950/50 lg:hidden"></div>
    <div class="min-w-0 flex-1">
        <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-slate-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <button id="open-sidebar" class="rounded-xl border border-slate-200 p-2 text-slate-600 lg:hidden">☰</button>
                <div><p class="text-sm font-semibold text-slate-900"><?php echo $__env->yieldContent('header', 'Dashboard'); ?></p><p class="hidden text-xs text-slate-400 sm:block">Rabu, <?php echo e(now()->translatedFormat('d F Y')); ?></p></div>
            </div>
            <div class="flex items-center gap-3"><span class="hidden rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 sm:inline-flex">● Sistem aktif</span><span class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-100 text-sm font-bold text-brand-700"><?php echo e(strtoupper(substr($staffUser->nama_lengkap ?? 'U', 0, 1))); ?></span></div>
        </header>
        <main class="p-4 sm:p-6 lg:p-8">
            <?php if (isset($component)) { $__componentOriginal5168fdb0c14fd91c6598264bc4be63f2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5168fdb0c14fd91c6598264bc4be63f2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5168fdb0c14fd91c6598264bc4be63f2)): ?>
<?php $attributes = $__attributesOriginal5168fdb0c14fd91c6598264bc4be63f2; ?>
<?php unset($__attributesOriginal5168fdb0c14fd91c6598264bc4be63f2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5168fdb0c14fd91c6598264bc4be63f2)): ?>
<?php $component = $__componentOriginal5168fdb0c14fd91c6598264bc4be63f2; ?>
<?php unset($__componentOriginal5168fdb0c14fd91c6598264bc4be63f2); ?>
<?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
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
<?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/layouts/dashboard.blade.php ENDPATH**/ ?>