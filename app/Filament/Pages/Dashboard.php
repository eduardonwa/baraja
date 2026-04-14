<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ContentMetricsOverview;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            ContentMetricsOverview::class
        ];
    }
}
