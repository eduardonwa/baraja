<x-filament-widgets::widget>
    <div style="display: flex; gap: 24px;">

        <div style="flex:1;">
            <p>Mejor publicación</p>
            <h3>
                {{ $best?->title ?? 'Sin datos' }}
            </h3>
        </div>

        <div style="flex:1;">
            <p>Peor publicación</p>
            <h3>
                {{ $worst?->title ?? 'Sin datos' }}
            </h3>
        </div>

    </div>
</x-filament-widgets::widget>