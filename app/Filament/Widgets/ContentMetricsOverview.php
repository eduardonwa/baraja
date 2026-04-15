<?php

namespace App\Filament\Widgets;

use App\Models\ContentMetric;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentMetricsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        // usar scopes
        $conversionMetrics = ContentMetric::withConversionData()->get();
        $engagementMetrics = ContentMetric::withEngagementData()->get();
        
        // promedios
        $avgViewToProfile = round(
            $conversionMetrics->avg(fn ($m) => $m->view_to_profile_visit_rate) ?? 0,
            2
        );

        $avgProfileToFollow = round(
            $conversionMetrics->avg(fn ($m) => $m->profile_to_follow_conversion_rate) ?? 0,
            2
        );

        $avgTotalEngagement = round(
            $engagementMetrics->avg(fn ($m) => $m->total_engagement_rate) ?? 0,
            2
        );

        return [
            Stat::make('Reach -> Profile', $avgViewToProfile . '%')
                ->description('How many profile visits came from content views.'),

            Stat::make('Profile -> Follow', $avgProfileToFollow . '%')
                ->description('How many people followed you after visiting your profile.'),

            Stat::make('Total Engagement', $avgTotalEngagement . '%')
                ->description('Total engagement based on likes, comments, shares, saves, and reposts.')
        ];
    }
}