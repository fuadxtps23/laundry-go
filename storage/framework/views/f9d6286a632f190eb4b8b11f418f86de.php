<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label',
    'value',
    'description' => null,
    'icon' => '•',
    'tone' => 'orange',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'label',
    'value',
    'description' => null,
    'icon' => '•',
    'tone' => 'orange',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $tones = [
        'orange' => 'bg-brand-100 text-brand-700',
        'green' => 'bg-emerald-100 text-emerald-700',
        'blue' => 'bg-blue-100 text-blue-700',
        'purple' => 'bg-violet-100 text-violet-700',
        'slate' => 'bg-slate-100 text-slate-700',
    ];
?>

<div <?php echo e($attributes->merge(['class' => 'card p-5'])); ?>>
    <div class="flex items-start justify-between gap-3">
        <div>
            <p class="text-sm font-medium text-slate-500"><?php echo e($label); ?></p>
            <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900"><?php echo e($value); ?></p>
            <?php if($description): ?>
                <p class="mt-1 text-xs text-slate-400"><?php echo e($description); ?></p>
            <?php endif; ?>
        </div>
        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-lg <?php echo e($tones[$tone] ?? $tones['orange']); ?>"><?php echo e($icon); ?></span>
    </div>
</div>
<?php /**PATH /home/notfuad/ngodingweb/www/laundry-go/resources/views/components/stat-card.blade.php ENDPATH**/ ?>