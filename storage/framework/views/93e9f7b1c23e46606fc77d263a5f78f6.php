<?php $__env->startSection('title', $transaction->kode_transaksi); ?>
<?php $__env->startSection('header', $transaction->kode_transaksi); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8"><a href="<?php echo e(route('customer.orders.index')); ?>" class="text-sm font-semibold text-brand-600">← Kembali ke pesanan</a><div class="mt-3 flex flex-col justify-between gap-4 sm:flex-row sm:items-end"><div><h1 class="page-title"><?php echo e($transaction->kode_transaksi); ?></h1><p class="page-subtitle">Dibuat <?php echo e($transaction->created_at->format('d F Y, H:i')); ?></p></div><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $transaction->status_laundry]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($transaction->status_laundry)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?></div></div>
<div class="grid gap-6 lg:grid-cols-3"><div class="card p-6 lg:col-span-2"><h2 class="font-bold text-slate-900">Detail laundry</h2><dl class="mt-6 grid gap-5 sm:grid-cols-2"><div><dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Layanan</dt><dd class="mt-1 font-semibold text-slate-800"><?php echo e($transaction->layanan->nama_layanan); ?></dd></div><div><dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Berat / jumlah</dt><dd class="mt-1 font-semibold text-slate-800"><?php echo e((float) $transaction->berat); ?> <?php echo e($transaction->layanan->satuan); ?></dd></div><div><dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tanggal masuk</dt><dd class="mt-1 font-semibold text-slate-800"><?php echo e($transaction->tanggal_masuk->format('d F Y')); ?></dd></div><div><dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Estimasi selesai</dt><dd class="mt-1 font-semibold text-slate-800"><?php echo e($transaction->tanggal_estimasi_selesai->format('d F Y')); ?></dd></div><div><dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Total tagihan</dt><dd class="mt-1 text-xl font-bold text-brand-600">Rp<?php echo e(number_format((float) $transaction->total_harga, 0, ',', '.')); ?></dd></div><div><dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Karyawan</dt><dd class="mt-1 font-semibold text-slate-800"><?php echo e($transaction->karyawan?->nama_lengkap ?? 'Belum ditugaskan'); ?></dd></div></dl><?php if($transaction->catatan): ?><div class="mt-6 rounded-xl bg-slate-50 p-4"><p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Catatan</p><p class="mt-1 text-sm text-slate-600"><?php echo e($transaction->catatan); ?></p></div><?php endif; ?></div><div class="space-y-6"><div class="card p-6"><h2 class="font-bold text-slate-900">Pembayaran</h2><p class="mt-4"><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
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
<?php endif; ?></p><?php if($transaction->status_pembayaran === \App\Enums\PaymentStatus::BelumDibayar): ?><a href="<?php echo e(route('customer.payments.show', $transaction)); ?>" class="btn-primary mt-5 w-full">Bayar sekarang</a><?php elseif($transaction->payment): ?><p class="mt-4 text-sm text-slate-500"><?php echo e($transaction->payment->metode->label()); ?> · <?php echo e($transaction->payment->tanggal_bayar?->format('d M Y, H:i')); ?></p><a href="<?php echo e(route('customer.payments.show', $transaction)); ?>" class="mt-4 inline-block text-sm font-semibold text-brand-600">Lihat detail →</a><?php endif; ?></div><div class="card p-6"><h2 class="font-bold text-slate-900">Ulasan</h2><?php if($transaction->review): ?><p class="mt-3 text-xl text-brand-500"><?php echo e(str_repeat('★', $transaction->review->bintang)); ?><span class="text-slate-200"><?php echo e(str_repeat('★', 5 - $transaction->review->bintang)); ?></span></p><p class="mt-2 text-sm text-slate-500"><?php echo e($transaction->review->ulasan); ?></p><?php elseif($transaction->canBeReviewed()): ?><p class="mt-3 text-sm text-slate-500">Laundry selesai? Berikan penilaian Anda.</p><a href="<?php echo e(route('customer.reviews.create', $transaction)); ?>" class="btn-secondary mt-4 w-full">Beri rating</a><?php else: ?><p class="mt-3 text-sm text-slate-400">Rating dapat diisi setelah laundry selesai atau diambil.</p><?php endif; ?></div></div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/customer/order-show.blade.php ENDPATH**/ ?>