<?php $__env->startSection('title', 'Pesan Laundry'); ?>
<?php $__env->startSection('header', 'Pesan laundry'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8"><a href="<?php echo e(route('customer.dashboard')); ?>" class="text-sm font-semibold text-brand-600">← Kembali ke dashboard</a><h1 class="page-title mt-3">Pesan laundry baru</h1><p class="page-subtitle">Pilih layanan, isi berat, dan kami akan menghitung harga otomatis.</p></div>
<form method="POST" action="<?php echo e(route('customer.orders.store')); ?>" class="grid gap-6 lg:grid-cols-3">
    <?php echo csrf_field(); ?>
    <div class="card p-6 lg:col-span-2"><div class="mb-6"><h2 class="font-bold text-slate-900">Detail pesanan</h2><p class="mt-1 text-sm text-slate-500">Pilih layanan yang sesuai untuk kebutuhan Anda.</p></div><fieldset><legend class="form-label">Layanan</legend><div class="grid gap-3 sm:grid-cols-2"><?php $__currentLoopData = $layanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><label class="group relative cursor-pointer rounded-2xl border border-slate-200 p-4 transition has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50 hover:border-brand-300"><input type="radio" name="layanan_id" value="<?php echo e($service->id); ?>" data-price="<?php echo e((float) $service->harga_per_kg); ?>" data-unit="<?php echo e($service->satuan); ?>" data-days="<?php echo e($service->estimasi_hari); ?>" class="peer sr-only" <?php if(old('layanan_id') == $service->id): echo 'checked'; endif; ?> required><div class="flex items-start justify-between gap-3"><div><p class="font-bold text-slate-800 group-has-[:checked]:text-brand-700"><?php echo e($service->nama_layanan); ?></p><p class="mt-1 text-xs leading-5 text-slate-500"><?php echo e($service->deskripsi); ?></p></div><span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-slate-300 text-white peer-checked:border-brand-500 peer-checked:bg-brand-500">✓</span></div><div class="mt-4 flex items-end justify-between"><span class="font-bold text-brand-600">Rp<?php echo e(number_format((float) $service->harga_per_kg, 0, ',', '.')); ?><small class="font-medium text-slate-400">/<?php echo e($service->satuan); ?></small></span><span class="text-xs text-slate-400"><?php echo e($service->estimasi_hari); ?> hari</span></div></label><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div><?php $__errorArgs = ['layanan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></fieldset><div class="mt-6 grid gap-4 sm:grid-cols-2"><div><label for="berat" class="form-label">Berat / jumlah</label><div class="relative"><input id="berat" type="number" name="berat" value="<?php echo e(old('berat')); ?>" min="0.1" step="0.01" class="form-input pr-16" placeholder="Contoh: 3.5" required><span id="unit-label" class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-sm text-slate-400">kg</span></div><?php $__errorArgs = ['berat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div><div><label for="tanggal_masuk" class="form-label">Tanggal masuk</label><input id="tanggal_masuk" type="date" name="tanggal_masuk" value="<?php echo e(old('tanggal_masuk', now()->format('Y-m-d'))); ?>" class="form-input" required><?php $__errorArgs = ['tanggal_masuk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div></div><div class="mt-4"><label for="catatan" class="form-label">Catatan <span class="font-normal text-slate-400">(opsional)</span></label><textarea id="catatan" name="catatan" rows="4" class="form-input" placeholder="Contoh:.colors putih, jangan direndam"><?php echo e(old('catatan')); ?></textarea><?php $__errorArgs = ['catatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div></div>
    <aside class="card h-fit p-6 lg:sticky lg:top-24"><h2 class="font-bold text-slate-900">Ringkasan harga</h2><div class="mt-5 rounded-xl bg-slate-50 p-4"><div class="flex justify-between text-sm text-slate-500"><span>Layanan</span><span id="summary-service" class="font-semibold text-slate-700">Pilih layanan</span></div><div class="mt-3 flex justify-between text-sm text-slate-500"><span>Berat / jumlah</span><span id="summary-weight" class="font-semibold text-slate-700">-</span></div><div class="my-4 border-t border-slate-200"></div><div class="flex items-end justify-between"><span class="font-semibold text-slate-700">Total tagihan</span><span id="summary-total" class="text-2xl font-bold text-brand-600">Rp0</span></div></div><p class="mt-4 text-xs leading-5 text-slate-400">Harga final dihitung dari berat × harga per satuan layanan.</p><button class="btn-primary mt-6 w-full py-3">Konfirmasi pesanan <span>→</span></button></aside>
</form>
<script>
    const cards = document.querySelectorAll('input[name="layanan_id"]');
    const weight = document.getElementById('berat');
    const unit = document.getElementById('unit-label');
    const serviceSummary = document.getElementById('summary-service');
    const weightSummary = document.getElementById('summary-weight');
    const totalSummary = document.getElementById('summary-total');
    const format = (value) => 'Rp' + Math.round(value).toLocaleString('id-ID');
    function updateSummary() {
        const selected = document.querySelector('input[name="layanan_id"]:checked');
        if (! selected) return;
        const price = Number(selected.dataset.price || 0);
        const value = Number(weight.value || 0);
        unit.textContent = selected.dataset.unit;
        serviceSummary.textContent = selected.closest('label').querySelector('p').textContent;
        weightSummary.textContent = value + ' ' + selected.dataset.unit;
        totalSummary.textContent = format(price * value);
    }
    cards.forEach((card) => card.addEventListener('change', updateSummary));
    weight.addEventListener('input', updateSummary);
    updateSummary();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/customer/order-create.blade.php ENDPATH**/ ?>