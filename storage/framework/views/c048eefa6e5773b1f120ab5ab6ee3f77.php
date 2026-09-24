<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Laundry Go'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>
    <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/90 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
            <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500 text-lg font-black text-white shadow-sm">LG</span>
                <span>
                    <span class="block text-lg font-extrabold tracking-tight text-brand-900">Laundry<span class="text-brand-500">Go</span></span>
                    <span class="block text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-400">Laundry tanpa ribet</span>
                </span>
            </a>
            <nav class="hidden items-center gap-7 text-sm font-semibold text-slate-600 md:flex">
                <a href="<?php echo e(route('home')); ?>" class="transition hover:text-brand-600">Beranda</a>
                <a href="<?php echo e(route('layanan')); ?>" class="transition hover:text-brand-600">Layanan</a>
                <?php if(auth()->guard('web')->check()): ?>
                    <a href="<?php echo e(route('customer.dashboard')); ?>" class="transition hover:text-brand-600">Dashboard</a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button class="text-slate-500 hover:text-red-600">Keluar</button></form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="text-slate-600 transition hover:text-brand-600">Masuk</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn-primary !px-4 !py-2">Daftar sekarang</a>
                <?php endif; ?>
            </nav>
            <details class="relative md:hidden">
                <summary class="flex h-10 w-10 cursor-pointer list-none items-center justify-center rounded-xl border border-slate-200 text-slate-600">☰</summary>
                <div class="absolute right-0 mt-3 w-52 rounded-2xl border border-slate-200 bg-white p-3 shadow-xl">
                    <a href="<?php echo e(route('home')); ?>" class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-brand-50">Beranda</a>
                    <a href="<?php echo e(route('layanan')); ?>" class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-brand-50">Layanan</a>
                    <?php if(auth()->guard('web')->check()): ?>
                        <a href="<?php echo e(route('customer.dashboard')); ?>" class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-brand-50">Dashboard</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button class="w-full rounded-lg px-3 py-2 text-left text-sm font-semibold text-red-600 hover:bg-red-50">Keluar</button></form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-brand-50">Masuk</a>
                        <a href="<?php echo e(route('register')); ?>" class="mt-1 block rounded-lg bg-brand-500 px-3 py-2 text-center text-sm font-semibold text-white">Daftar</a>
                    <?php endif; ?>
                </div>
            </details>
        </div>
    </header>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-8 text-sm text-slate-500 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
            <p><span class="font-bold text-brand-900">LaundryGo</span> — laundry cepat, bersih, dan praktis.</p>
            <p>© <?php echo e(date('Y')); ?> Laundry Go. Semua hak dilindungi.</p>
        </div>
    </footer>
</body>
</html>
<?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/layouts/app.blade.php ENDPATH**/ ?>