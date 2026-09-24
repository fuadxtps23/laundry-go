@if (session('success'))
    <div class="mb-5 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800" role="alert">
        <span class="mt-0.5 text-lg">✓</span>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800" role="alert">
        <span class="mt-0.5 text-lg">!</span>
        <span>{{ session('error') }}</span>
    </div>
@endif

@if ($errors->any())
    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
        <p class="font-semibold">Periksa kembali isian Anda.</p>
        <ul class="mt-1 list-disc space-y-0.5 pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
