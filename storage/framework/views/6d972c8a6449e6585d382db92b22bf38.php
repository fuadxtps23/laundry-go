<?php $__env->startSection('title', 'Rating & Ulasan'); ?>
<?php $__env->startSection('header', 'Rating & ulasan'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8"><a href="<?php echo e(route('customer.orders.show', $transaksi)); ?>" class="text-sm font-semibold text-brand-600">← Kembali ke pesanan</a><h1 class="page-title mt-3">Bagaimana laundry Anda?</h1><p class="page-subtitle">Beri rating untuk transaksi <span class="font-semibold text-slate-700"><?php echo e($transaksi->kode_transaksi); ?></span>.</p></div>
<form method="POST" action="<?php echo e(route('customer.reviews.store', $transaksi)); ?>" class="max-w-2xl"><?php echo csrf_field(); ?><div class="card p-6 sm:p-8"><fieldset><legend class="form-label">Rating layanan</legend><div class="mt-3 flex gap-2" id="star-inputs"><?php for($star=1;$star<=5;$star++): ?><label class="cursor-pointer"><input type="radio" name="bintang" value="<?php echo e($star); ?>" class="peer sr-only" <?php if(old('bintang', 5) == $star): echo 'checked'; endif; ?> required><span class="flex h-12 w-12 items-center justify-center rounded-xl border border-slate-200 text-2xl text-slate-300 transition peer-checked:border-brand-300 peer-checked:bg-brand-50 peer-checked:text-brand-500 hover:bg-brand-50 sm:h-14 sm:w-14">★</span></label><?php endfor; ?></div><p class="mt-2 text-xs text-slate-400">1 = kurangpuas, 5 = sangat puas</p><?php $__errorArgs = ['bintang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></fieldset><div class="mt-7"><label for="ulasan" class="form-label">Ulasan <span class="font-normal text-slate-400">(opsional)</span></label><textarea id="ulasan" name="ulasan" rows="5" class="form-input" placeholder="Ceritakan pengalaman laundry Anda..."><?php echo e(old('ulasan')); ?></textarea><?php $__errorArgs = ['ulasan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><button class="btn-primary mt-7 w-full py-3 sm:w-auto">Kirim ulasan <span>→</span></button></div></form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/customer/review-create.blade.php ENDPATH**/ ?>