<?php

namespace App\Filament\Resources\ContentMetrics\Pages;

use App\Filament\Resources\ContentMetrics\ContentMetricResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContentMetrics extends ListRecords
{
    protected static string $resource = ContentMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
