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
    $user = $user ?? auth('web')->user();
?>
<div class="min-h-screen lg:flex">
    <aside id="customer-sidebar" class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full bg-white shadow-xl transition-transform lg:static lg:translate-x-0 lg:shadow-none">
        <div class="flex h-full flex-col border-r border-slate-200">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-6">
                <a href="<?php echo e(route('customer.dashboard')); ?>" class="flex items-center gap-3"><span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500 font-black text-white">LG</span><span><span class="block text-lg font-extrabold text-brand-900">Laundry<span class="text-brand-500">Go</span></span><span class="block text-[10px] uppercase tracking-[0.2em] text-slate-400">Customer area</span></span></a>
                <button id="close-customer-sidebar" class="rounded-lg p-1 text-slate-400 hover:bg-slate-100 lg:hidden">×</button>
            </div>
            <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-6">
                <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Menu</p>
                <?php
                    $customerNav = [
                        ['Dashboard', 'customer.dashboard', '▦'],
                        ['Pesan Laundry', 'customer.orders.create', '＋'],
                        ['Pesanan Saya', 'customer.orders.index', '▤'],
                        ['Layanan', 'layanan', '✦'],
                        ['Profil', 'customer.profile.edit', '♙'],
                    ];
                ?>
                <?php $__currentLoopData = $customerNav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $routeName, $icon]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $active = request()->routeIs($routeName) || request()->routeIs($routeName.'.*'); ?>
                    <a href="<?php echo e(route($routeName)); ?>" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition <?php echo e($active ? 'bg-brand-100 text-brand-800' : 'text-slate-500 hover:bg-brand-50 hover:text-brand-700'); ?>"><span class="w-5 text-center text-base"><?php echo e($icon); ?></span><?php echo e($label); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </nav>
            <div class="border-t border-slate-100 p-4"><form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-slate-500 hover:bg-red-50 hover:text-red-600">↪ <span>Keluar</span></button></form></div>
        </div>
    </aside>
    <div id="customer-overlay" class="fixed inset-0 z-40 hidden bg-slate-950/50 lg:hidden"></div>
    <div class="min-w-0 flex-1">
        <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-slate-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
            <div class="flex items-center gap-3"><button id="open-customer-sidebar" class="rounded-xl border border-slate-200 p-2 text-slate-600 lg:hidden">☰</button><div><p class="text-sm font-semibold text-slate-900"><?php echo $__env->yieldContent('header', 'Dashboard'); ?></p><p class="hidden text-xs text-slate-400 sm:block"><?php echo e(now()->translatedFormat('l, d F Y')); ?></p></div></div>
            <div class="flex items-center gap-3"><a href="<?php echo e(route('customer.orders.create')); ?>" class="btn-primary hidden !px-3 !py-2 sm:inline-flex">＋ Pesan laundry</a><span class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-100 text-sm font-bold text-brand-700"><?php echo e(strtoupper(substr($user->nama_lengkap, 0, 1))); ?></span></div>
        </header>
        <main class="p-4 sm:p-6 lg:p-8"><?php if (isset($component)) { $__componentOriginal5168fdb0c14fd91c6598264bc4be63f2 = $component; } ?>
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
<?php endif; ?><?php echo $__env->yieldContent('content'); ?></main>
    </div>
</div>
<script>
    const sidebar = document.getElementById('customer-sidebar');
    const overlay = document.getElementById('customer-overlay');
    const open = () => { sidebar?.classList.remove('-translate-x-full'); overlay?.classList.remove('hidden'); };
    const close = () => { sidebar?.classList.add('-translate-x-full'); overlay?.classList.add('hidden'); };
    document.getElementById('open-customer-sidebar')?.addEventListener('click', open);
    document.getElementById('close-customer-sidebar')?.addEventListener('click', close);
    overlay?.addEventListener('click', close);
</script>
</body>
</html>
<?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/layouts/customer.blade.php ENDPATH**/ ?>