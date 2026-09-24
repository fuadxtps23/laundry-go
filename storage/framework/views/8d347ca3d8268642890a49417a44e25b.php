<?php $__env->startSection('title', 'Profil Saya'); ?>
<?php $__env->startSection('header', 'Profil saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8"><h1 class="page-title">Profil saya</h1><p class="page-subtitle">Kelola informasi akun dan keamanan Anda.</p></div>
<div class="grid gap-6 lg:grid-cols-2"><form method="POST" action="<?php echo e(route('customer.profile.update')); ?>" class="card p-6"><?php echo csrf_field(); ?><div class="flex items-center gap-4 border-b border-slate-100 pb-5"><span class="flex h-14 w-14 items-center justify-center rounded-full bg-brand-100 text-xl font-bold text-brand-700"><?php echo e(strtoupper(substr($user->nama_lengkap, 0, 1))); ?></span><div><h2 class="font-bold text-slate-900"><?php echo e($user->nama_lengkap); ?></h2><p class="text-sm text-slate-500"><?php echo e($user->poin); ?> poin laundry</p></div></div><h3 class="mt-6 font-bold text-slate-900">Informasi akun</h3><div class="mt-4 space-y-4"><div><label class="form-label" for="nama_lengkap">Nama lengkap</label><input class="form-input" id="nama_lengkap" name="nama_lengkap" value="<?php echo e(old('nama_lengkap', $user->nama_lengkap)); ?>" required><?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="username">Username</label><input class="form-input" id="username" name="username" value="<?php echo e(old('username', $user->username)); ?>" required><?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="email">Email</label><input class="form-input" id="email" type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="no_hp">No. HP</label><input class="form-input" id="no_hp" name="no_hp" value="<?php echo e(old('no_hp', $user->no_hp)); ?>" required><?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="alamat">Alamat</label><textarea class="form-input" id="alamat" name="alamat" rows="3" required><?php echo e(old('alamat', $user->alamat)); ?></textarea><?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div></div><button class="btn-primary mt-6">Simpan perubahan</button></form><form method="POST" action="<?php echo e(route('customer.profile.password')); ?>" class="card h-fit p-6"><?php echo csrf_field(); ?><h2 class="font-bold text-slate-900">Ganti password</h2><p class="mt-2 text-sm text-slate-500">Gunakan password minimal 8 karakter.</p><div class="mt-5 space-y-4"><div><label class="form-label" for="password_lama">Password lama</label><input class="form-input" id="password_lama" type="password" name="password_lama" required><?php $__errorArgs = ['password_lama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="password">Password baru</label><input class="form-input" id="password" type="password" name="password" required><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label class="form-label" for="password_confirmation">Konfirmasi password baru</label><input class="form-input" id="password_confirmation" type="password" name="password_confirmation" required></div></div><button class="btn-secondary mt-6">Perbarui password</button></form></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/customer/profile.blade.php ENDPATH**/ ?>