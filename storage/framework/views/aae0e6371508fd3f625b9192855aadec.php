<?php $__env->startSection('title', 'Laporan'); ?>
<?php $__env->startSection('header', 'Laporan'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end"><div><h1 class="page-title">Laporan laundry</h1><p class="page-subtitle">Rekap transaksi dan pendapatan berdasarkan periode.</p></div><div class="flex gap-2"><a href="<?php echo e(route($role.'.reports.export', array_merge(request()->query(), ['format'=>'csv']))); ?>" class="btn-secondary">Export CSV</a><a href="<?php echo e(route($role.'.reports.export', request()->query())); ?>" target="_blank" class="btn-primary">Export PDF</a></div></div>
<form method="GET" action="<?php echo e(route($role.'.reports.index')); ?>" class="card mb-6 grid gap-4 p-5 sm:grid-cols-2 lg:grid-cols-5"><div><label class="form-label" for="period">Periode</label><select id="period" name="period" class="form-input"><option value="harian" <?php if($period === 'harian'): echo 'selected'; endif; ?>>Harian</option><option value="mingguan" <?php if($period === 'mingguan'): echo 'selected'; endif; ?>>Mingguan</option><option value="bulanan" <?php if($period === 'bulanan'): echo 'selected'; endif; ?>>Bulanan</option></select></div><div><label class="form-label" for="from">Dari tanggal</label><input id="from" type="date" name="from" value="<?php echo e($from->format('Y-m-d')); ?>" class="form-input"></div><div><label class="form-label" for="to">Sampai tanggal</label><input id="to" type="date" name="to" value="<?php echo e($to->format('Y-m-d')); ?>" class="form-input"></div><div><label class="form-label" for="status">Status laundry</label><select id="status" name="status" class="form-input"><option value="">Semua status</option><?php $__currentLoopData = \App\Enums\LaundryStatus::cases(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($item->value); ?>" <?php if(request('status') === $item->value): echo 'selected'; endif; ?>><?php echo e($item->label()); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div><div class="flex items-end"><button class="btn-primary w-full">Terapkan laporan</button></div></form>
<div class="grid gap-4 sm:grid-cols-3"><?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Jumlah transaksi','value' => $transactions->count(),'description' => 'Pada periode terpilih','icon' => '▤','tone' => 'blue']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Jumlah transaksi','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($transactions->count()),'description' => 'Pada periode terpilih','icon' => '▤','tone' => 'blue']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Transaksi lunas','value' => $paidTransactions->count(),'description' => 'Sudah terverifikasi','icon' => '✓','tone' => 'green']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Transaksi lunas','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($paidTransactions->count()),'description' => 'Sudah terverifikasi','icon' => '✓','tone' => 'green']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Pendapatan','value' => 'Rp'.number_format($revenue, 0, ',', '.'),'description' => 'Total tagihan lunas','icon' => 'Rp','tone' => 'orange']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Pendapatan','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Rp'.number_format($revenue, 0, ',', '.')),'description' => 'Total tagihan lunas','icon' => 'Rp','tone' => 'orange']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?></div>
<?php if($role === 'admin'): ?><div class="card mt-6 overflow-hidden"><div class="border-b border-slate-100 px-5 py-5"><h2 class="font-bold text-slate-900">Rekap per karyawan</h2><p class="mt-1 text-xs text-slate-400">Transaksi dan pendapatan yang ditugaskan</p></div><div class="table-wrap"><table class="data-table"><thead><tr><th>Karyawan</th><th>Jabatan</th><th>Transaksi</th><th>Pendapatan</th></tr></thead><tbody><?php $__currentLoopData = $employeeRecap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><tr><td class="font-semibold text-slate-800"><?php echo e($recap['employee']->nama_lengkap); ?></td><td><?php echo e($recap['employee']->posisi_jabatan); ?></td><td><?php echo e($recap['count']); ?></td><td class="font-semibold text-brand-600">Rp<?php echo e(number_format($recap['revenue'], 0, ',', '.')); ?></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php if($employeeRecap->isEmpty()): ?><tr><td colspan="4" class="py-8 text-center text-slate-400">Belum ada data karyawan.</td></tr><?php endif; ?></tbody></table></div></div><?php endif; ?>
<div class="card table-wrap mt-6"><div class="border-b border-slate-100 px-5 py-5"><h2 class="font-bold text-slate-900">Rincian transaksi</h2><p class="mt-1 text-xs text-slate-400"><?php echo e($from->format('d M Y')); ?> — <?php echo e($to->format('d M Y')); ?></p></div><table class="data-table"><thead><tr><th>Kode</th><th>Tanggal</th><th>Pelanggan</th><th>Layanan</th><th>Total</th><th>Status</th><th>Pembayaran</th></tr></thead><tbody><?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><tr><td class="font-semibold text-brand-700"><?php echo e($transaction->kode_transaksi); ?></td><td><?php echo e($transaction->tanggal_masuk->format('d M Y')); ?></td><td><?php echo e($transaction->user->nama_lengkap); ?></td><td><?php echo e($transaction->layanan->nama_layanan); ?></td><td class="font-semibold">Rp<?php echo e(number_format((float) $transaction->total_harga, 0, ',', '.')); ?></td><td><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
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
<?php endif; ?></td><td><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
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
<?php endif; ?></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="7" class="py-12 text-center text-slate-400">Tidak ada transaksi pada periode ini.</td></tr><?php endif; ?></tbody></table></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/staff/reports/index.blade.php ENDPATH**/ ?>