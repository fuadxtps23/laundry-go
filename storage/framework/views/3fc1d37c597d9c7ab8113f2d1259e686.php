<?php $__env->startSection('title', 'Edit Transaksi'); ?>
<?php $__env->startSection('header', 'Edit transaksi'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8"><a href="<?php echo e(route($role.'.transactions.show', $transaction)); ?>" class="text-sm font-semibold text-brand-600">← Kembali ke detail</a><h1 class="page-title mt-3">Edit transaksi <?php echo e($transaction->kode_transaksi); ?></h1><p class="page-subtitle">Perbarui data operasional tanpa mengubah status laundry.</p></div>
<form method="POST" action="<?php echo e(route($role.'.transactions.update', $transaction)); ?>" class="max-w-3xl"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?><div class="card p-6 sm:p-8"><div class="grid gap-5 sm:grid-cols-2"><div class="sm:col-span-2"><label class="form-label" for="layanan_id">Layanan</label><select id="layanan_id" name="layanan_id" class="form-input" required><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($service->id); ?>" <?php if($transaction->layanan_id === $service->id): echo 'selected'; endif; ?>><?php echo e($service->nama_layanan); ?> · Rp<?php echo e(number_format((float) $service->harga_per_kg, 0, ',', '.')); ?>/<?php echo e($service->satuan); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select><?php $__errorArgs = ['layanan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="berat">Berat / jumlah</label><input id="berat" type="number" step="0.01" min="0.1" name="berat" value="<?php echo e(old('berat', $transaction->berat)); ?>" class="form-input" required><?php $__errorArgs = ['berat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><?php if($role === 'admin'): ?><div><label class="form-label" for="karyawan_id">Karyawan</label><select id="karyawan_id" name="karyawan_id" class="form-input"><option value="">Belum ditugaskan</option><?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($employee->id); ?>" <?php if($transaction->karyawan_id === $employee->id): echo 'selected'; endif; ?>><?php echo e($employee->nama_lengkap); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select><?php $__errorArgs = ['karyawan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><?php else: ?><div><span class="form-label">Karyawan</span><p class="form-input bg-slate-50"><?php echo e($transaction->karyawan?->nama_lengkap ?? 'Belum ditugaskan'); ?></p></div><?php endif; ?><div><label class="form-label" for="tanggal_masuk">Tanggal masuk</label><input id="tanggal_masuk" type="date" name="tanggal_masuk" value="<?php echo e(old('tanggal_masuk', $transaction->tanggal_masuk->format('Y-m-d'))); ?>" class="form-input" required><?php $__errorArgs = ['tanggal_masuk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="tanggal_estimasi_selesai">Estimasi selesai</label><input id="tanggal_estimasi_selesai" type="date" name="tanggal_estimasi_selesai" value="<?php echo e(old('tanggal_estimasi_selesai', $transaction->tanggal_estimasi_selesai->format('Y-m-d'))); ?>" class="form-input" required><?php $__errorArgs = ['tanggal_estimasi_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div class="sm:col-span-2"><label class="form-label" for="catatan">Catatan</label><textarea id="catatan" name="catatan" rows="4" class="form-input"><?php echo e(old('catatan', $transaction->catatan)); ?></textarea><?php $__errorArgs = ['catatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div></div><div class="mt-7 flex justify-end gap-3"><a href="<?php echo e(route($role.'.transactions.show', $transaction)); ?>" class="btn-secondary">Batal</a><button class="btn-primary">Simpan perubahan</button></div></div></form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/staff/transactions/edit.blade.php ENDPATH**/ ?>