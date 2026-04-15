<?php

namespace App\Filament\Widgets;

use App\Models\ContentMetric;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EngagementBreakdownOverview extends BaseWidget
{
    protected static ?int $sort = 4;

    protected function getStats(): array
    {
        $metrics = ContentMetric::query()
            ->withEngagementData()
            ->get();

        $avgLikesRate = round($metrics->avg('likes_engagement_rate') ?? 0, 2);
        $avgSavesRate = round($metrics->avg('saves_engagement_rate') ?? 0, 2);
        $avgCommentsRate = round($metrics->avg('comments_engagement_rate') ?? 0, 2);

        return [
            Stat::make('Attraction', number_format($avgLikesRate) . '%')
                ->description('Likes altos = contenido atractivo')
                ->icon('heroicon-m-hand-thumb-up')
                ->color('success'),

            Stat::make('Utility', number_format($avgSavesRate) . '%')
                ->description('Saves altos = contenido útil')
                ->icon('heroicon-m-bookmark')
                ->color('warning'),

            Stat::make('Conversation', number_format($avgCommentsRate) . '%')
                ->description('Comments altos = genera conversación')
                ->icon('heroicon-m-chat-bubble-left-right')
                ->color('primary'),
        ];
    }
}