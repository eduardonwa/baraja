<x-filament-widgets::widget>
    {{--
        Contenedor general de la sección Volume.
        La idea es dividir visualmente en:
        - izquierda: KPI principal + sparkline
        - derecha: métricas secundarias
    --}}
    <div style="display: flex; gap: 24px; align-items: stretch;">
        {{--
            COLUMNA IZQUIERDA
            Esta es la parte protagonista.
            Ocupa más espacio porque aquí vive la historia principal:
            promedio de views + comportamiento por post.
        --}}
        <div style="flex: 2;">
            <x-filament::section>
                {{--
                    KPI principal.
                    Resume el volumen promedio de views por post en 7 días.
                --}}
                <div style="margin-bottom: 16px;">
                    <p>
                        Avg Views (7d)
                    </p>

                    <h2 style="font-size: 2rem; margin: 0;">
                        {{ $avgViews }}
                    </h2>
                </div>

                {{--
                    Sparkline.
                    Muestra cómo se distribuyen individualmente los posts.
                    No es otro promedio.
                    Cada punto representa un post y su views_7d.
                --}}
                <div>
                    @php
                        $values = $sparkline;
                        $count = count($values);

                        if ($count === 0) {
                            $values = [0];
                            $count = 1;
                        }

                        $max = max($values);
                        $min = min($values);
                        $range = $max - $min ?: 1;

                        $width = 100;
                        $height = 40;
                        $stepX = $width / ($count - 1 ?: 1);

                        $points = [];

                        foreach ($values as $i => $value) {
                            $x = $i * $stepX;
                            $y = $height - (($value - $min) / $range * $height);

                            $points[] = "{$x},{$y}";
                        }

                        $pointsString = implode(' ', $points);
                    @endphp

                    <svg width="100%" height="60" viewBox="0 0 100 40" preserveAspectRatio="none">
                        <polyline
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            points="{{ $pointsString }}"
                        />
                    </svg>
                </div>
            </x-filament::section>
        </div>
        {{--
            COLUMNA DERECHA
            Esta parte da contexto.
            No debe competir con el KPI principal.
            Por eso se apila verticalmente.
        --}}
        <div style="flex: 1; display: flex; flex-direction: column; gap: 16px; padding: 16px; padding-inline: 24px 0;">

            {{--
                Métrica secundaria 1:
                promedio de visitas al perfil.
                Sirve como contexto del volumen, pero no manda.
            --}}
            <div>
                <p>
                    Avg Profile Visits (7d)
                </p>

                <h3 style="font-size: 1.5rem; margin: 0;">
                    {{ $avgProfileVisits }}
                </h3>

                <p style="margin: 0;">
                    Promedio de visitas al perfil.
                </p>
            </div>

            {{--
                Métrica secundaria 2:
                cantidad de posts analizados.
                Esto ayuda a entender el tamaño de la muestra.
            --}}
            <div>
                <p>
                    Total Posts
                </p>

                <h3 style="font-size: 1.5rem; margin: 0;">
                    {{ $totalPosts }}
                </h3>

                <p style="margin: 0;">
                    Posts incluidos en este análisis.
                </p>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>