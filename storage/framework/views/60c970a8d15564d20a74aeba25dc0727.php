<?php $__env->startSection('title', 'Masuk'); ?>
<?php $__env->startSection('eyebrow', 'Selamat datang kembali'); ?>
<?php $__env->startSection('headline', 'Cuci 😌, kami yang handalkan.'); ?>
<?php $__env->startSection('footer'); ?>
    Belum punya akun?
    <a class="font-semibold text-brand-600 hover:text-brand-700" href="<?php echo e(route('register')); ?>">Daftar Sekarang</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('form'); ?>
    <div class="mb-7">
        <p class="text-sm font-semibold text-brand-600">Laundry Go</p>
        <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Masuk ke Laundry Go</h2>
        <p class="mt-2 text-sm text-slate-500">Gunakan username atau email yang terdaftar.</p>
    </div>
    <form method="POST" action="<?php echo e(route('login.post')); ?>" class="space-y-5">
        <?php echo csrf_field(); ?>
        <div>
            <label for="login" class="form-label">Username atau Email</label>
            <input id="login" name="login" value="<?php echo e(old('login')); ?>" class="form-input" autocomplete="username" required autofocus>
            <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
            <div class="flex items-center justify-between"><label for="password" class="form-label">Password</label><span class="text-xs text-slate-400">Minimal 8 karakter</span></div>
            <input id="password" type="password" name="password" class="form-input" autocomplete="current-password" required>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <label class="flex items-center gap-2 text-sm text-slate-600"><input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-brand-500 focus:ring-brand-400"> Ingat saya</label>
        <button class="btn-primary w-full py-3">Masuk <span>→</span></button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/auth/login.blade.php ENDPATH**/ ?>