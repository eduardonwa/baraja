<x-filament-widgets::widget>
    {{-- 
        Este widget es el breakdown del funnel.
        No es una lista de stats homogéneos.
        Su función es explicar dónde está la fricción.
    --}}

        {{--
            Encabezado general del bloque.
            Aquí introduces qué representa esta sección.
        --}}
        <div>
            <p>
                {{ $subheading }}
            </p>
        </div>

        {{--
            Contenedor principal de las dos etapas.
            Luego aquí puedes decidir si visualmente
            las pones una debajo de otra o lado a lado.
        --}}
        <div>
            {{--
                Etapa 1 del funnel:
                cuántos viewers terminaron entrando al perfil.
            --}}
            <div>
                {{--
                    Etiqueta de la etapa.
                --}}
                <p>
                    {{ $viewToProfileLabel }}
                </p>

                {{--
                    Valor principal de esta etapa.
                --}}
                <strong>
                    {{ $viewToProfileValue }}
                </strong>

                {{--
                    Texto interpretativo.
                    Explica qué significa ese porcentaje.
                --}}
                <p>
                    {{ $viewToProfileText }}
                </p>
            </div>

            {{--
                Etapa 2 del funnel:
                cuántas visitas al perfil terminaron en follow.
            --}}
            <div>
                <p>
                    {{ $profileToFollowLabel }}
                </p>

                <strong>
                    {{ $profileToFollowValue }}
                </strong>

                <p>
                    {{ $profileToFollowText }}
                </p>
            </div>
        </div>
</x-filament-widgets::widget>