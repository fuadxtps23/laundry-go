<?php $__env->startSection('title', 'Edit Pelanggan'); ?>
<?php $__env->startSection('header', 'Edit pelanggan'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8"><a href="<?php echo e(route($role.'.customers.index')); ?>" class="text-sm font-semibold text-brand-600">← Kembali ke pelanggan</a><h1 class="page-title mt-3">Edit <?php echo e($user->nama_lengkap); ?></h1><p class="page-subtitle">Perbarui informasi akun pelanggan.</p></div><form method="POST" action="<?php echo e(route($role.'.customers.update', $user)); ?>" class="max-w-3xl"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?><div class="card p-6 sm:p-8"><div class="grid gap-5 sm:grid-cols-2"><div class="sm:col-span-2"><label class="form-label" for="nama_lengkap">Nama lengkap</label><input id="nama_lengkap" name="nama_lengkap" value="<?php echo e(old('nama_lengkap', $user->nama_lengkap)); ?>" class="form-input" required><?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="username">Username</label><input id="username" name="username" value="<?php echo e(old('username', $user->username)); ?>" class="form-input" required><?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="no_hp">No. HP</label><input id="no_hp" name="no_hp" value="<?php echo e(old('no_hp', $user->no_hp)); ?>" class="form-input" required><?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="email">Email</label><input id="email" type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" class="form-input" required><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="alamat">Alamat</label><textarea id="alamat" name="alamat" rows="3" class="form-input" required><?php echo e(old('alamat', $user->alamat)); ?></textarea><?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="password">Password baru <span class="font-normal text-slate-400">(opsional)</span></label><input id="password" type="password" name="password" class="form-input"><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="password_confirmation">Konfirmasi password</label><input id="password_confirmation" type="password" name="password_confirmation" class="form-input"></div></div><div class="mt-7 flex justify-end gap-3"><a href="<?php echo e(route($role.'.customers.index')); ?>" class="btn-secondary">Batal</a><button class="btn-primary">Simpan perubahan</button></div></div></form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/staff/customers/edit.blade.php ENDPATH**/ ?>