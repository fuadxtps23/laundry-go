<?php $__env->startSection('title', 'Rating & Ulasan'); ?>
<?php $__env->startSection('header', 'Rating & ulasan'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8"><h1 class="page-title">Rating & ulasan</h1><p class="page-subtitle">Lihat feedback pelanggan terhadap layanan laundry.</p></div><div class="grid gap-4 sm:grid-cols-3"><?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Rating rata-rata','value' => number_format($averageRating, 1, ',', '.'),'description' => 'Skala 1 sampai 5','icon' => '★','tone' => 'orange']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Rating rata-rata','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format($averageRating, 1, ',', '.')),'description' => 'Skala 1 sampai 5','icon' => '★','tone' => 'orange']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?><?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Jumlah ulasan','value' => $totalReviews,'description' => 'Ulasan tersimpan','icon' => '▤','tone' => 'blue']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Jumlah ulasan','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalReviews),'description' => 'Ulasan tersimpan','icon' => '▤','tone' => 'blue']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?><?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Kepuasan pelanggan','value' => $averageRating >= 4 ? 'Baik' : ($averageRating >= 3 ? 'Cukup' : 'Perlu perbaikan'),'description' => 'Berdasarkan rating','icon' => '♡','tone' => 'green']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Kepuasan pelanggan','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($averageRating >= 4 ? 'Baik' : ($averageRating >= 3 ? 'Cukup' : 'Perlu perbaikan')),'description' => 'Berdasarkan rating','icon' => '♡','tone' => 'green']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?></div><div class="card table-wrap mt-6"><table class="data-table"><thead><tr><th>Pelanggan</th><th>Transaksi</th><th>Rating</th><th>Ulasan</th><th>Tanggal</th></tr></thead><tbody><?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><tr><td><p class="font-semibold text-slate-800"><?php echo e($review->user->nama_lengkap); ?></p><p class="text-xs text-slate-400"><?php echo e($review->user->no_hp); ?></p></td><td><a href="<?php echo e(route($role.'.transactions.show', $review->transaction)); ?>" class="font-semibold text-brand-600"><?php echo e($review->transaction->kode_transaksi); ?></a><p class="text-xs text-slate-400"><?php echo e($review->transaction->layanan->nama_layanan); ?></p></td><td><span class="whitespace-nowrap text-lg text-brand-500"><?php echo e(str_repeat('★', $review->bintang)); ?><span class="text-slate-200"><?php echo e(str_repeat('★', 5 - $review->bintang)); ?></span></span></td><td class="max-w-md whitespace-normal text-slate-600"><?php echo e($review->ulasan ?: 'Tidak ada ulasan teks.'); ?></td><td><?php echo e($review->created_at->format('d M Y')); ?></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="5" class="py-14 text-center text-slate-400">Belum ada ulasan pelanggan.</td></tr><?php endif; ?></tbody></table></div><?php if($reviews->hasPages()): ?><div class="mt-5"><?php echo e($reviews->links()); ?></div><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/staff/reviews/index.blade.php ENDPATH**/ ?>