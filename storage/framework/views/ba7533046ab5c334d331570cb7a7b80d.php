<?php $__env->startSection('title', $employee->nama_lengkap); ?>
<?php $__env->startSection('header', 'Detail karyawan'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end"><div><a href="<?php echo e(route('admin.karyawan.index')); ?>" class="text-sm font-semibold text-brand-600">← Kembali ke karyawan</a><h1 class="page-title mt-3"><?php echo e($employee->nama_lengkap); ?></h1><p class="page-subtitle">Detail akun dan transaksi karyawan.</p></div><a href="<?php echo e(route('admin.karyawan.edit', $employee)); ?>" class="btn-secondary">Edit karyawan</a></div><div class="grid gap-6 lg:grid-cols-3"><div class="card p-6"><div class="flex items-center gap-4"><span class="flex h-16 w-16 items-center justify-center rounded-full bg-brand-100 text-2xl font-bold text-brand-700"><?php echo e(strtoupper(substr($employee->nama_lengkap, 0, 1))); ?></span><div><h2 class="font-bold text-slate-900"><?php echo e($employee->nama_lengkap); ?></h2><p class="text-sm text-slate-500"><?php echo e($employee->posisi_jabatan); ?></p></div></div><dl class="mt-6 space-y-4 text-sm"><div><dt class="text-xs text-slate-400">Username</dt><dd class="mt-1 font-semibold text-slate-700"><?php echo e($employee->username); ?></dd></div><div><dt class="text-xs text-slate-400">Email</dt><dd class="mt-1 font-semibold text-slate-700"><?php echo e($employee->email); ?></dd></div><div><dt class="text-xs text-slate-400">No. HP</dt><dd class="mt-1 font-semibold text-slate-700"><?php echo e($employee->no_hp); ?></dd></div><div><dt class="text-xs text-slate-400">Total transaksi</dt><dd class="mt-1 text-xl font-bold text-brand-600"><?php echo e($employee->transactions_count); ?></dd></div></dl></div><div class="card table-wrap lg:col-span-2"><div class="border-b border-slate-100 px-5 py-5"><h2 class="font-bold text-slate-900">Transaksi Ditangani</h2></div><table class="data-table"><thead><tr><th>Kode</th><th>Pelanggan</th><th>Layanan</th><th>Total</th><th>Status</th><th></th></tr></thead><tbody><?php $__empty_1 = true; $__currentLoopData = $employee->transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><tr><td class="font-semibold text-brand-700"><?php echo e($transaction->kode_transaksi); ?></td><td><?php echo e($transaction->user->nama_lengkap); ?></td><td><?php echo e($transaction->layanan->nama_layanan); ?></td><td>Rp<?php echo e(number_format((float) $transaction->total_harga, 0, ',', '.')); ?></td><td><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
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
<?php endif; ?></td><td><a href="<?php echo e(route('admin.transactions.show', $transaction)); ?>" class="font-semibold text-brand-600">Detail</a></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="6" class="py-12 text-center text-slate-400">Belum ada transaksi.</td></tr><?php endif; ?></tbody></table></div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/staff/employees/show.blade.php ENDPATH**/ ?>