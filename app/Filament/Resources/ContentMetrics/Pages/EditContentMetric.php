<?php

namespace App\Filament\Resources\ContentMetrics\Pages;

use App\Filament\Resources\ContentMetrics\ContentMetricResource;
use App\Filament\Resources\ContentPosts\ContentPostResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContentMetric extends EditRecord
{
    protected static string $resource = ContentMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            Action::make('backToPost')
                ->label('Publicación')
                ->icon('heroicon-o-arrow-uturn-left')
                ->url(fn () => ContentPostResource::getUrl('edit', [
                    'record' => $this->record->metricable->id,
                ])),
        ];
    }
}
