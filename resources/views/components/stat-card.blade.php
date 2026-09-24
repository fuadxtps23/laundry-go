@props([
    'label',
    'value',
    'description' => null,
    'icon' => '•',
    'tone' => 'orange',
])

@php
    $tones = [
        'orange' => 'bg-brand-100 text-brand-700',
        'green' => 'bg-emerald-100 text-emerald-700',
        'blue' => 'bg-blue-100 text-blue-700',
        'purple' => 'bg-violet-100 text-violet-700',
        'slate' => 'bg-slate-100 text-slate-700',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'card p-5']) }}>
    <div class="flex items-start justify-between gap-3">
        <div>
            <p class="text-sm font-medium text-slate-500">{{ $label }}</p>
            <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">{{ $value }}</p>
            @if ($description)
                <p class="mt-1 text-xs text-slate-400">{{ $description }}</p>
            @endif
        </div>
        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-lg {{ $tones[$tone] ?? $tones['orange'] }}">{{ $icon }}</span>
    </div>
</div>
