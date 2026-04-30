<div class="rounded-xl border border-white/10 bg-white/[0.03] p-5">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <div>
            <p class="text-sm text-gray-400">Confianza</p>
            <p class="mt-1 text-4xl font-bold text-white">
                {{ $confidence }}%
            </p>
            <p class="mt-1 text-xs text-gray-500">
                Calculado automáticamente
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-400">Señales positivas</p>
            <p class="mt-1 text-3xl font-semibold text-emerald-400">
                {{ $positive }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-400">Señales negativas</p>
            <p class="mt-1 text-3xl font-semibold text-red-400">
                {{ $negative }}
            </p>
        </div>
    </div>
</div>