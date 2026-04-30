@php
    $label = $labels[$variable] ?? null;

    $displayValue = $variable === 'other'
        ? $variableCustom
        : $label;

    $displayValue = filled($displayValue) ? $displayValue : '—';
@endphp

<div class="rounded-xl border border-white/10 bg-white/[0.03] p-5 h-full flex flex-col items-center justify-center">
    <p class="text-sm text-gray-400 text-center">Variable</p>

    <p class="mt-2 text-2xl font-semibold text-white text-center">
        {{ $displayValue }}
    </p>

    @if ($variable === 'other')
        <p class="mt-1 text-xs text-gray-500">
            Variable personalizada
        </p>
    @endif
</div>