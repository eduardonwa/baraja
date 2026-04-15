<?php

namespace App\Filament\Widgets;

use App\Models\ContentMetric;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PostsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $topPost = ContentMetric::query()
            ->with(['rotationCycleItem'])
            ->withEngagementData()
            ->get()
            ->sortByDesc('view_to_profile_conversion_rate')
            ->first();

        $worstPost = ContentMetric::query()
            ->with(['rotationCycleItem'])
            ->withEngagementData()
            ->get()
            ->sortBy('view_to_profile_conversion_rate')
            ->first();

        $totalPosts = ContentMetric::query()
            ->withEngagementData()
            ->count();

        return [
            Stat::make(
                'Best Performing Post',
                $topPost
                    ? $this->formatPostValue($topPost)
                    : 'Sin datos'
            )
                ->description(
                    $topPost
                        ? $this->getPostTitle($topPost)
                        : 'No available posts with views'
                )
                ->icon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Total Posts', number_format($totalPosts))
                ->description('In the last 7 days')
                ->icon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make(
                'Worst Performing Post',
                $worstPost
                    ? $this->formatPostValue($worstPost)
                    : 'Sin datos'
            )
                ->description(
                    $worstPost
                        ? $this->getPostTitle($worstPost)
                        : 'No available posts with views'
                )
                ->icon('heroicon-m-arrow-trending-down')
                ->color('danger'),
        ];
    }

    protected function formatPostValue(ContentMetric $metric): string
    {
        return number_format($metric->view_to_profile_conversion_rate, 2) . '%';
    }

    protected function getPostTitle(ContentMetric $metric): string
    {
        return $metric->title
            ?? $metric->rotationCycleItem?->title
            ?? "Post #{$metric->id}";
    }
}