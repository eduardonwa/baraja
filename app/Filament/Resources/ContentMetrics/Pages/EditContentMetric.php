<?php

namespace App\Filament\Resources\ContentMetrics\Pages;

use App\Filament\Resources\ContentMetrics\ContentMetricResource;
use App\Filament\Resources\ContentPosts\ContentPostResource;
use App\Filament\Resources\Hypotheses\HypothesisResource;
use App\Models\ContentPost;
use App\Models\LabPost;
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
                ->url(function () {
                    $metricable = $this->record->metricable;

                    if ($metricable instanceof ContentPost) {
                        return ContentPostResource::getUrl('edit', [
                            'record' => $metricable->id,
                        ]);
                    }

                    if ($metricable instanceof LabPost) {
                        return HypothesisResource::getUrl('edit', [
                            'record' => $metricable->hypothesisTest->hypothesis_id
                        ]);
                    }

                    return null;
                })
        ];
    }
}
