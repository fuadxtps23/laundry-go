<?php $__env->startSection('title', 'Daftar'); ?>
<?php $__env->startSection('eyebrow', 'Mulai lebih mudah'); ?>
<?php $__env->startSection('headline', 'Laundry bersih, waktu untuk Anda.'); ?>
<?php $__env->startSection('footer'); ?>
    Sudah punya akun?
    <a class="font-semibold text-brand-600 hover:text-brand-700" href="<?php echo e(route('login')); ?>">Masuk di sini</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('form'); ?>
    <div class="mb-7">
        <p class="text-sm font-semibold text-brand-600">Buat akun gratis</p>
        <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Daftar sebagai pelanggan</h2>
        <p class="mt-2 text-sm text-slate-500">Satu akun untuk pesan, pantau, dan bayar laundry.</p>
    </div>
    <form method="POST" action="<?php echo e(route('register.store')); ?>" class="space-y-4">
        <?php echo csrf_field(); ?>
        <div><label for="nama_lengkap" class="form-label">Nama lengkap</label><input id="nama_lengkap" name="nama_lengkap" value="<?php echo e(old('nama_lengkap')); ?>" class="form-input" required><?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label for="username" class="form-label">Username</label><input id="username" name="username" value="<?php echo e(old('username')); ?>" class="form-input" required><?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
            <div><label for="no_hp" class="form-label">No. HP</label><input id="no_hp" name="no_hp" value="<?php echo e(old('no_hp')); ?>" class="form-input" required><?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
        </div>
        <div><label for="email" class="form-label">Email</label><input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-input" required><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
        <div><label for="alamat" class="form-label">Alamat</label><textarea id="alamat" name="alamat" rows="2" class="form-input" required><?php echo e(old('alamat')); ?></textarea><?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label for="password" class="form-label">Password</label><input id="password" type="password" name="password" class="form-input" required><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
            <div><label for="password_confirmation" class="form-label">Konfirmasi password</label><input id="password_confirmation" type="password" name="password_confirmation" class="form-input" required></div>
        </div>
        <button class="btn-primary mt-2 w-full py-3">Buat akun gratis <span>→</span></button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/auth/customer-register.blade.php ENDPATH**/ ?>