<?php $__env->startSection('title', $transaction->kode_transaksi); ?>
<?php $__env->startSection('header', 'Detail transaksi'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end"><div><a href="<?php echo e(route($role.'.transactions.index')); ?>" class="text-sm font-semibold text-brand-600">← Kembali ke transaksi</a><h1 class="page-title mt-3"><?php echo e($transaction->kode_transaksi); ?></h1><p class="page-subtitle">Detail pesanan pelanggan <?php echo e($transaction->user->nama_lengkap); ?>.</p></div><div class="flex gap-2"><a href="<?php echo e(route($role.'.transactions.edit', $transaction)); ?>" class="btn-secondary">Edit data</a><form method="POST" action="<?php echo e(route($role.'.transactions.destroy', $transaction)); ?>" onsubmit="return confirm('Hapus transaksi ini?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn-danger">Hapus</button></form></div></div>
<div class="grid gap-6 lg:grid-cols-3"><div class="card p-6 lg:col-span-2"><h2 class="font-bold text-slate-900">Informasi transaksi</h2><dl class="mt-6 grid gap-5 sm:grid-cols-2"><div><dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Pelanggan</dt><dd class="mt-1 font-semibold text-slate-800"><?php echo e($transaction->user->nama_lengkap); ?></dd><dd class="text-xs text-slate-400"><?php echo e($transaction->user->no_hp); ?> · <?php echo e($transaction->user->email); ?></dd></div><div><dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Layanan</dt><dd class="mt-1 font-semibold text-slate-800"><?php echo e($transaction->layanan->nama_layanan); ?></dd><dd class="text-xs text-slate-400"><?php echo e($transaction->layanan->satuan); ?></dd></div><div><dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Berat / jumlah</dt><dd class="mt-1 font-semibold text-slate-800"><?php echo e((float) $transaction->berat); ?> <?php echo e($transaction->layanan->satuan); ?></dd></div><div><dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Total harga</dt><dd class="mt-1 text-lg font-bold text-brand-600">Rp<?php echo e(number_format((float) $transaction->total_harga, 0, ',', '.')); ?></dd></div><div><dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tanggal masuk</dt><dd class="mt-1 font-semibold text-slate-800"><?php echo e($transaction->tanggal_masuk->format('d F Y')); ?></dd></div><div><dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Estimasi selesai</dt><dd class="mt-1 font-semibold text-slate-800"><?php echo e($transaction->tanggal_estimasi_selesai->format('d F Y')); ?></dd></div></dl><?php if($transaction->catatan): ?><div class="mt-6 rounded-xl bg-slate-50 p-4"><p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Catatan pelanggan</p><p class="mt-1 text-sm text-slate-600"><?php echo e($transaction->catatan); ?></p></div><?php endif; ?></div><div class="space-y-6"><div class="card p-6"><h2 class="font-bold text-slate-900">Status laundry</h2><div class="mt-4"><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
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
<?php endif; ?></div><?php if($transaction->status_laundry->next()): ?><form method="POST" action="<?php echo e(route($role.'.transactions.status', $transaction)); ?>" class="mt-5"><?php echo csrf_field(); ?><label class="form-label" for="status_laundry">Ubah ke status berikutnya</label><select id="status_laundry" name="status_laundry" class="form-input"><option value="<?php echo e($transaction->status_laundry->next()->value); ?>"><?php echo e($transaction->status_laundry->next()->label()); ?></option></select><button class="btn-primary mt-3 w-full">Perbarui status</button></form><?php else: ?><p class="mt-4 text-xs text-slate-400">Status sudah berjalan sampai selesai.</p><?php endif; ?></div><div class="card p-6"><h2 class="font-bold text-slate-900">Pembayaran</h2><div class="mt-4"><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
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
<?php endif; ?></div><?php if($transaction->payment): ?><p class="mt-3 text-sm text-slate-500"><?php echo e($transaction->payment->metode->label()); ?> · Rp<?php echo e(number_format((float) $transaction->payment->jumlah_bayar, 0, ',', '.')); ?></p><?php if($transaction->payment->bukti_pembayaran): ?><a href="<?php echo e(Storage::disk('public')->url($transaction->payment->bukti_pembayaran)); ?>" target="_blank" class="mt-3 inline-block text-sm font-semibold text-brand-600">Lihat bukti →</a><?php endif; ?>@else<p class="mt-3 text-sm text-slate-400">Belum ada pembayaran.</p><?php endif; ?></div><?php if($role === 'admin'): ?><div class="card p-6"><h2 class="font-bold text-slate-900">Karyawan penanggung jawab</h2><form method="POST" action="<?php echo e(route('admin.transactions.assign', $transaction)); ?>" class="mt-4"><?php echo csrf_field(); ?><select name="karyawan_id" class="form-input" required><option value="">Pilih karyawan</option><?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($employee->id); ?>" <?php if($transaction->karyawan_id === $employee->id): echo 'selected'; endif; ?>><?php echo e($employee->nama_lengkap); ?> · <?php echo e($employee->posisi_jabatan); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select><button class="btn-primary mt-3 w-full">Simpan penugasan</button></form></div><?php endif; ?></div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/staff/transactions/show.blade.php ENDPATH**/ ?>