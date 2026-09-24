<?php $__env->startSection('title', 'Pesanan Saya'); ?>
<?php $__env->startSection('header', 'Pesanan saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end"><div><h1 class="page-title">Pesanan saya</h1><p class="page-subtitle">Semua transaksi laundry yang pernah Anda buat.</p></div><a href="<?php echo e(route('customer.orders.create')); ?>" class="btn-primary">＋ Pesan laundry</a></div>
<div class="card table-wrap"><table class="data-table"><thead><tr><th>Kode transaksi</th><th>Tanggal</th><th>Layanan</th><th>Berat</th><th>Total harga</th><th>Status laundry</th><th>Status pembayaran</th><th>Aksi</th></tr></thead><tbody><?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><tr><td class="font-semibold text-slate-800"><?php echo e($transaction->kode_transaksi); ?></td><td><?php echo e($transaction->tanggal_masuk->format('d M Y')); ?></td><td><?php echo e($transaction->layanan->nama_layanan); ?></td><td><?php echo e(rtrim(rtrim(number_format((float) $transaction->berat, 2, ',', '.'), '0'), ',')); ?> <?php echo e($transaction->layanan->satuan); ?></td><td class="font-semibold text-slate-800">Rp<?php echo e(number_format((float) $transaction->total_harga, 0, ',', '.')); ?></td><td><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $transaction->status_laundry]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($transaction->status_laundry)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?></td><td><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $transaction->status_pembayaran]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($transaction->status_pembayaran)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?></td><td><div class="flex items-center gap-3"><a href="<?php echo e(route('customer.orders.show', $transaction)); ?>" class="font-semibold text-brand-600">Detail</a><?php if($transaction->status_pembayaran === \App\Enums\PaymentStatus::BelumDibayar): ?><a href="<?php echo e(route('customer.payments.show', $transaction)); ?>" class="font-semibold text-emerald-600">Bayar</a><?php endif; ?> <?php if($transaction->canBeReviewed()): ?><a href="<?php echo e(route('customer.reviews.create', $transaction)); ?>" class="font-semibold text-violet-600">Rating</a><?php endif; ?></div></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="8" class="py-14 text-center"><p class="font-semibold text-slate-600">Belum ada pesanan.</p><a href="<?php echo e(route('customer.orders.create')); ?>" class="mt-2 inline-block text-sm font-semibold text-brand-600">Mulai pesan laundry →</a></td></tr><?php endif; ?></tbody></table></div><?php if($transactions->hasPages()): ?><div class="mt-5"><?php echo e($transactions->links()); ?></div><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/customer/orders.blade.php ENDPATH**/ ?>