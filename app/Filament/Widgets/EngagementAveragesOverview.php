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
        $avgLikesRate = round($metrics->avg('likes_engagement_rate') ?? 0, 2);
        $avgSavesRate = round($metrics->avg('saves_engagement_rate') ?? 0, 2);

        return [
            Stat::make('Avg Views', number_format($avgViews))
                ->description('Promedio de views por post')
                ->icon('heroicon-m-eye')
                ->color('primary'),

            Stat::make('Avg Likes %', number_format($avgLikesRate) . '%')
                ->description('Promedio de likes_engagement_rate')
                ->icon('heroicon-m-hand-thumb-up')
                ->color('success'),

            Stat::make('Avg Saves %', number_format($avgSavesRate) . '%')
                ->description('Promedio de saves_engagement_rate')
                ->icon('heroicon-m-bookmark')
                ->color('warning'),
        ];
    }
}