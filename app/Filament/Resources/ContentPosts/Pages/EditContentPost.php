<?php

namespace App\Filament\Resources\ContentPosts\Pages;

use App\Filament\Resources\ContentMetrics\ContentMetricResource;
use App\Filament\Resources\ContentPosts\ContentPostResource;
use App\Filament\Resources\Hypotheses\HypothesisResource;
use App\Models\ContentPost;
use App\Models\Hypothesis;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;

class EditContentPost extends EditRecord
{
    protected static string $resource = ContentPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            Action::make('viewMetrics')
                ->label('Ver métricas')
                ->icon('heroicon-o-chart-bar')
                ->url(fn () => $this->record?->metric
                    ? ContentMetricResource::getUrl('edit', [
                        'record' => $this->record->metric,
                    ])
                    : null
                )
                ->visible(fn () => $this->record?->metric !== null),
        ];
    }
}
