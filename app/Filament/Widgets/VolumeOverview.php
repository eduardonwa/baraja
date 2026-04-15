<?php

namespace App\Filament\Widgets;

use App\Models\ContentMetric;
use Filament\Widgets\Widget;

class VolumeOverview extends Widget
{
    protected string $view = 'filament.widgets.volume-overview';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 3;

    public function getViewData(): array
    {
        // Últimos posts que quieres usar para el sparkline.
        // En tu caso actual: 14, porque publicas 2 por día durante 7 días.
        $posts = ContentMetric::query()
            ->latest()
            ->take(14)
            ->get();

        // KPI principal: promedio de views_7d de esos posts.
        $avgViews = round($posts->avg('views_7d') ?? 0);

        // Métrica secundaria: promedio de profile_visits_7d de esos mismos posts.
        $avgProfileVisits = round($posts->avg('profile_visits_7d') ?? 0);

        // Contexto: cuántos posts entraron al análisis.
        $totalPosts = $posts->count();

        // Serie del sparkline: views_7d por post.
        // Se revierte para que visualmente vaya de izquierda (más viejo)
        // a derecha (más reciente).
        $sparkline = $posts
            ->pluck('views_7d')
            ->reverse()
            ->values()
            ->toArray();

        return [
            'avgViews' => number_format($avgViews),
            'avgProfileVisits' => number_format($avgProfileVisits),
            'totalPosts' => number_format($totalPosts),
            'sparkline' => $sparkline,
        ];
    }
}