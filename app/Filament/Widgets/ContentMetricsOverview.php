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
            $conversionMetrics->avg(fn ($m) => $m->view_to_profile_conversion_rate) ?? 0,
            2
        );

        $avgProfileToFollow = round(
            $conversionMetrics->avg(fn ($m) => $m->profile_visit_to_follow_conversion_rate) ?? 0,
            2
        );

        $avgTotalEngagement = round(
            $engagementMetrics->avg(fn ($m) => $m->total_engagement_rate) ?? 0,
            2
        );

        return [
            Stat::make('Views -> Profile (7d)', $avgViewToProfile . '%')
                ->description('How many profile visits came from content views after 7 days.'),

            Stat::make('Profile -> Follow (7d)', $avgProfileToFollow . '%')
                ->description('How many people followed you after visiting your profile, based on 7-day data.'),

            Stat::make('Total Engagement (7d)', $avgTotalEngagement . '%')
                ->description('Final engagement rate based on all interactions after 7 days.')
        ];
    }
}