<?php

namespace App\Filament\Resources\ContentMetrics\Pages;

use App\Filament\Resources\ContentMetrics\ContentMetricResource;
use App\Filament\Resources\ContentPosts\ContentPostResource;
use App\Filament\Resources\Hypotheses\HypothesisResource;
use App\Models\ContentMetric;
use App\Models\ContentPost;
use App\Models\Hypothesis;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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

            Action::make('createHypothesis')
                ->label('Vigilar variable')
                ->icon('heroicon-o-magnifying-glass-circle')
                ->schema([
                    Select::make('variable')
                        ->options(Hypothesis::VARIABLE_LABELS)
                        ->required(),
                    TextInput::make('title')
                        ->label('Título')
                        ->required(),
                    Textarea::make('insight')
                        ->label('Observación')
                        ->nullable(),
                ])
                ->visible(fn (ContentMetric $record) => $record->metricable instanceof ContentPost)
                ->action(function (ContentMetric $record, array $data) {
                    $post = $record->metricable;

                    $hypothesis = Hypothesis::create([
                        'source_content_post_id' => $post->id,
                        'variable' => $data['variable'],
                        'title' => $data['title'],
                        'insight' => $data['insight'] ?? null,
                        'status' => 'observing'
                    ]);

                    return redirect(HypothesisResource::getUrl('edit', [
                        'record' => $hypothesis
                    ]));
                })
        ];
    }
}
