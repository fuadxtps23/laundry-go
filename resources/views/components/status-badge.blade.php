@props(['status'])

@if ($status instanceof \App\Enums\LaundryStatus)
    <span {{ $attributes->merge(['class' => 'inline-flex rounded-full px-2.5 py-1 text-xs font-semibold '.$status->badgeClass()]) }}>{{ $status->label() }}</span>
@elseif ($status instanceof \App\Enums\PaymentStatus)
    <span {{ $attributes->merge(['class' => 'inline-flex rounded-full px-2.5 py-1 text-xs font-semibold '.$status->badgeClass()]) }}>{{ $status->label() }}</span>
@else
    <span {{ $attributes->merge(['class' => 'inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700']) }}>{{ $status }}</span>
@endif
