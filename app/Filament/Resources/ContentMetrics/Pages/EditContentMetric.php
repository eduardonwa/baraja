<?php

namespace App\Filament\Resources\ContentMetrics\Pages;

use App\Filament\Resources\ContentMetrics\ContentMetricResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditContentMetric extends EditRecord
{
    protected static string $resource = ContentMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
