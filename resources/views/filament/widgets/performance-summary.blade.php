<x-filament-widgets::widget>
    <div class="performance-summary">

        <div class="performance-card">
            <p class="label">Mejor publicación</p>
            <h3 class="post">
                {{ $best?->title ?? 'Sin datos' }}
            </h3>
        </div>

        <div class="performance-card">
            <p class="label">Peor publicación</p>
            <h3 class="post">
                {{ $worst?->title ?? 'Sin datos' }}
            </h3>
        </div>

    </div>
</x-filament-widgets::widget>