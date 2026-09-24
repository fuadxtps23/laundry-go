<?php $__env->startSection('title', 'Data Transaksi'); ?>
<?php $__env->startSection('header', 'Data transaksi'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end"><div><h1 class="page-title">Data transaksi</h1><p class="page-subtitle">Kelola, filter, dan perbarui progres seluruh pesanan laundry.</p></div></div>
<form method="GET" action="<?php echo e(route($role.'.transactions.index')); ?>" class="card mb-6 grid gap-3 p-4 sm:grid-cols-2 lg:grid-cols-5"><div class="lg:col-span-2"><label class="form-label" for="search">Cari transaksi</label><input id="search" name="search" value="<?php echo e($search); ?>" class="form-input" placeholder="Kode, nama, atau no HP"></div><div><label class="form-label" for="status">Status laundry</label><select id="status" name="status" class="form-input"><option value="">Semua status</option><?php $__currentLoopData = \App\Enums\LaundryStatus::cases(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($item->value); ?>" <?php if($status === $item->value): echo 'selected'; endif; ?>><?php echo e($item->label()); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div><div><label class="form-label" for="payment_status">Status bayar</label><select id="payment_status" name="payment_status" class="form-input"><option value="">Semua pembayaran</option><?php $__currentLoopData = \App\Enums\PaymentStatus::cases(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($item->value); ?>" <?php if($paymentStatus === $item->value): echo 'selected'; endif; ?>><?php echo e($item->label()); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div><div class="flex items-end"><button class="btn-primary w-full">Terapkan filter</button></div></form>
<div class="card table-wrap"><table class="data-table"><thead><tr><th>Kode</th><th>Pelanggan</th><th>Tanggal masuk</th><th>Layanan</th><th>Berat</th><th>Total</th><th>Status laundry</th><th>Bayar</th><th>Aksi</th></tr></thead><tbody><?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><tr><td class="font-semibold text-brand-700"><?php echo e($transaction->kode_transaksi); ?></td><td><span class="block font-semibold text-slate-800"><?php echo e($transaction->user->nama_lengkap); ?></span><span class="text-xs text-slate-400"><?php echo e($transaction->user->no_hp); ?></span></td><td><?php echo e($transaction->tanggal_masuk->format('d M Y')); ?></td><td><?php echo e($transaction->layanan->nama_layanan); ?></td><td><?php echo e((float) $transaction->berat); ?> <?php echo e($transaction->layanan->satuan); ?></td><td class="font-semibold text-slate-800">Rp<?php echo e(number_format((float) $transaction->total_harga, 0, ',', '.')); ?></td><td><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
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
<?php endif; ?></td><td><div class="flex items-center gap-3"><a href="<?php echo e(route($role.'.transactions.show', $transaction)); ?>" class="font-semibold text-brand-600">Detail</a><a href="<?php echo e(route($role.'.transactions.edit', $transaction)); ?>" class="font-semibold text-slate-500">Edit</a></div></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="9" class="py-14 text-center text-slate-400">Data transaksi tidak ditemukan.</td></tr><?php endif; ?></tbody></table></div><?php if($transactions->hasPages()): ?><div class="mt-5"><?php echo e($transactions->links()); ?></div><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/staff/transactions/index.blade.php ENDPATH**/ ?>