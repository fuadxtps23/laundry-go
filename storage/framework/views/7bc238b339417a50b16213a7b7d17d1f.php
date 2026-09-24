<?php $__env->startSection('title', 'Tambah Layanan'); ?>
<?php $__env->startSection('header', 'Tambah layanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8"><a href="<?php echo e(route($role.'.services.index')); ?>" class="text-sm font-semibold text-brand-600">← Kembali ke layanan</a><h1 class="page-title mt-3">Tambah layanan</h1><p class="page-subtitle">Buat layanan baru yang dapat dipilih pelanggan.</p></div><form method="POST" action="<?php echo e(route($role.'.services.store')); ?>" class="max-w-3xl"><?php echo csrf_field(); ?><div class="card p-6 sm:p-8"><div class="grid gap-5 sm:grid-cols-2"><div class="sm:col-span-2"><label class="form-label" for="nama_layanan">Nama layanan</label><input id="nama_layanan" name="nama_layanan" value="<?php echo e(old('nama_layanan')); ?>" class="form-input" required><?php $__errorArgs = ['nama_layanan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div class="sm:col-span-2"><label class="form-label" for="deskripsi">Deskripsi</label><textarea id="deskripsi" name="deskripsi" rows="3" class="form-input"><?php echo e(old('deskripsi')); ?></textarea><?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="harga_per_kg">Harga per satuan</label><input id="harga_per_kg" type="number" step="0.01" min="0" name="harga_per_kg" value="<?php echo e(old('harga_per_kg')); ?>" class="form-input" required><?php $__errorArgs = ['harga_per_kg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="satuan">Satuan</label><select id="satuan" name="satuan" class="form-input" required><option value="kg">Kilogram (kg)</option><option value="pasang">Pasang</option><option value="potong">Potong</option><option value="m2">Meter persegi (m²)</option></select><?php $__errorArgs = ['satuan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="estimasi_hari">Estimasi hari</label><input id="estimasi_hari" type="number" min="1" max="30" name="estimasi_hari" value="<?php echo e(old('estimasi_hari', 1)); ?>" class="form-input" required><?php $__errorArgs = ['estimasi_hari'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><label class="flex items-center gap-3 self-end rounded-xl border border-slate-200 p-3"><input type="checkbox" name="is_active" value="1" <?php if(old('is_active', true)): echo 'checked'; endif; ?> class="rounded border-slate-300 text-brand-500 focus:ring-brand-400"><span class="text-sm font-semibold text-slate-700">Aktifkan layanan</span></label></div><div class="mt-7 flex justify-end gap-3"><a href="<?php echo e(route($role.'.services.index')); ?>" class="btn-secondary">Batal</a><button class="btn-primary">Simpan layanan</button></div></div></form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/staff/services/create.blade.php ENDPATH**/ ?>