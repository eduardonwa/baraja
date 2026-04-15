<?php

namespace App\Filament\Widgets;

use App\Models\ContentMetric;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EngagementAveragesOverview extends BaseWidget
{
    protected static ?int $sort = 3;

    protected function getStats(): array
    {
        $metrics = ContentMetric::query()
            ->withEngagementData()
            ->get();

        $avgViews = round($metrics->avg('views_7d') ?? 0, 2);
        $avgProfileVisits = round($metrics->avg('profile_visits_7d') ?? 0, 2);
        $avgTotalEngagementRate = round($metrics->avg('total_engagement_rate') ?? 0, 2);

        return [
            Stat::make('Avg Views', number_format($avgViews))
                ->description('Promedio de views por post')
                ->icon('heroicon-m-eye')
                ->color('primary'),

            Stat::make('Avg Profile Visits', number_format($avgProfileVisits))
                ->description('Promedio de visitas al perfil')
                ->icon('heroicon-m-user')
                ->color('info'),

            Stat::make('Avg Engagement %', number_format($avgTotalEngagementRate) . '%')
                ->description('Promedio de engagement total por views')
                ->icon('heroicon-m-sparkles')
                ->color('success'),
        ];
    }
}