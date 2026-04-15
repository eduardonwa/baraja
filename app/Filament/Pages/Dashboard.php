<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ContentMetricsOverview;
use App\Filament\Widgets\ConversionEfficiencyOverview;
use App\Filament\Widgets\EngagementAveragesOverview;
use App\Filament\Widgets\EngagementBreakdownOverview;
use App\Filament\Widgets\PostsOverview;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            ContentMetricsOverview::class,
            PostsOverview::class,
            EngagementAveragesOverview::class,
            EngagementBreakdownOverview::class,
            ConversionEfficiencyOverview::class
        ];
    }
}
