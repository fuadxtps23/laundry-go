<?php $__env->startSection('title', 'Pembayaran'); ?>
<?php $__env->startSection('header', 'Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8"><a href="<?php echo e(route('customer.orders.show', $transaction)); ?>" class="text-sm font-semibold text-brand-600">← Kembali ke detail pesanan</a><h1 class="page-title mt-3">Selesaikan pembayaran</h1><p class="page-subtitle">Transaksi <span class="font-semibold text-slate-700"><?php echo e($transaction->kode_transaksi); ?></span> · Total <span class="font-bold text-brand-600">Rp<?php echo e(number_format((float) $transaction->total_harga, 0, ',', '.')); ?></span></p></div>
<?php if($transaction->status_pembayaran === \App\Enums\PaymentStatus::Lunas): ?><div class="card p-8 text-center"><span class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 text-2xl text-emerald-600">✓</span><h2 class="mt-4 text-xl font-bold text-slate-900">Pembayaran sudah lunas</h2><p class="mt-2 text-sm text-slate-500">Terima kasih, pembayaran Anda sudah terverifikasi.</p></div><?php else: ?><form method="POST" action="<?php echo e(route('customer.payments.store', $transaction)); ?>" enctype="multipart/form-data" class="grid gap-6 lg:grid-cols-3"><?php echo csrf_field(); ?><div class="card p-6 lg:col-span-2"><h2 class="font-bold text-slate-900">Pilih metode pembayaran</h2><div class="mt-5 space-y-3"><?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-slate-200 p-4 transition has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50"><input type="radio" name="metode" value="<?php echo e($method->value); ?>" class="mt-1 text-brand-500 focus:ring-brand-400" <?php if(old('metode', 'direct') === $method->value): echo 'checked'; endif; ?> required><span><span class="block font-semibold text-slate-800"><?php echo e($method->label()); ?></span><span class="mt-1 block text-xs leading-5 text-slate-500"><?php if($method->value === 'direct'): ?> Bayar langsung di outlet, lalu tim kami akan mengonfirmasi.<?php elseif($method->value === 'qris'): ?> Scan QRIS Laundry Go dan unggah bukti transfer.<?php else: ?> Transfer ke BCA 1234567890 a.n. Laundry Go, lalu unggah bukti.<?php endif; ?></span></span></label><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div><div class="mt-6 grid gap-4 sm:grid-cols-2"><div><label for="jumlah_bayar" class="form-label">Jumlah bayar</label><input id="jumlah_bayar" type="number" name="jumlah_bayar" value="<?php echo e(old('jumlah_bayar', number_format((float) $transaction->total_harga, 2, '.', ''))); ?>" min="0.01" step="0.01" class="form-input" required><?php $__errorArgs = ['jumlah_bayar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div id="proof-field" class="hidden"><label for="bukti_pembayaran" class="form-label">Bukti pembayaran <span class="text-red-500">*</span></label><input id="bukti_pembayaran" type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf" class="form-input"><?php $__errorArgs = ['bukti_pembayaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div></div></div><aside class="card h-fit p-6"><h2 class="font-bold text-slate-900">Ringkasan</h2><div class="mt-4 space-y-3 text-sm"><div class="flex justify-between text-slate-500"><span>Kode transaksi</span><b class="text-slate-800"><?php echo e($transaction->kode_transaksi); ?></b></div><div class="flex justify-between text-slate-500"><span>Total tagihan</span><b class="text-brand-600">Rp<?php echo e(number_format((float) $transaction->total_harga, 0, ',', '.')); ?></b></div><div class="flex justify-between text-slate-500"><span>Status</span><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
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
<?php endif; ?></div></div><button class="btn-primary mt-6 w-full py-3">Kirim pembayaran <span>→</span></button><p class="mt-3 text-center text-xs text-slate-400">Bukti JPG/PNG/PDF maksimal 2 MB.</p></aside></form><?php endif; ?>
<script>const methodInputs = document.querySelectorAll('input[name="metode"]'); const proof = document.getElementById('proof-field'); const proofInput = document.getElementById('bukti_pembayaran'); function toggleProof() { const method = document.querySelector('input[name="metode"]:checked')?.value; const required = method === 'qris' || method === 'transfer'; proof?.classList.toggle('hidden', !required); if (proofInput) proofInput.required = required; } methodInputs.forEach((input) => input.addEventListener('change', toggleProof)); toggleProof();</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/customer/payment.blade.php ENDPATH**/ ?>