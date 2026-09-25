<?php $__env->startSection('title', 'Tambah Karyawan'); ?>
<?php $__env->startSection('header', 'Tambah karyawan'); ?>

<?php $__env->startSection('content'); ?>
<?php ($selectedPosition = old('posisi_jabatan', '')); ?>
<div class="mb-8"><a href="<?php echo e(route('admin.karyawan.index')); ?>" class="text-sm font-semibold text-brand-600">← Kembali ke karyawan</a><h1 class="page-title mt-3">Buat akun karyawan</h1><p class="page-subtitle">Karyawan dapat masuk ke area operasional setelah akun dibuat.</p></div><form method="POST" action="<?php echo e(route('admin.karyawan.store')); ?>" class="max-w-3xl"><?php echo csrf_field(); ?><div class="card p-6 sm:p-8"><div class="grid gap-5 sm:grid-cols-2"><div class="sm:col-span-2"><label class="form-label" for="nama_lengkap">Nama lengkap</label><input id="nama_lengkap" name="nama_lengkap" value="<?php echo e(old('nama_lengkap')); ?>" class="form-input" required><?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="username">Username</label><input id="username" name="username" value="<?php echo e(old('username')); ?>" class="form-input" required><?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="no_hp">No. HP</label><input id="no_hp" name="no_hp" value="<?php echo e(old('no_hp')); ?>" class="form-input" required><?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="email">Email</label><input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-input" required><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="posisi_jabatan">Posisi/jabatan</label><select id="posisi_jabatan" name="posisi_jabatan" class="form-input" required><option value="" disabled <?php if($selectedPosition === ''): echo 'selected'; endif; ?>>Pilih posisi/jabatan</option><?php $__currentLoopData = \App\Models\Karyawan::POSITIONS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($position); ?>" <?php if($selectedPosition === $position): echo 'selected'; endif; ?>><?php echo e($position); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select><?php $__errorArgs = ['posisi_jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="password">Password</label><input id="password" type="password" name="password" class="form-input" required><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="password_confirmation">Konfirmasi password</label><input id="password_confirmation" type="password" name="password_confirmation" class="form-input" required></div></div><div class="mt-7 flex justify-end gap-3"><a href="<?php echo e(route('admin.karyawan.index')); ?>" class="btn-secondary">Batal</a><button class="btn-primary">Buat akun karyawan</button></div></div></form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/staff/employees/create.blade.php ENDPATH**/ ?>