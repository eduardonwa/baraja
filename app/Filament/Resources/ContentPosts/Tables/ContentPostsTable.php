<?php

namespace App\Filament\Resources\ContentPosts\Tables;

use App\Filament\Resources\ContentMetrics\ContentMetricResource;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContentPostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Tipo de publicación')
                    ->searchable(),
                TextColumn::make('accountPlatforms.network')
                    ->label('Plataformas')
                    ->badge()
                    ->separator(', ')
                    ->searchable(),
                TextColumn::make('published_at')
                    ->label('Publicado')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('viewMetrics')
                    ->label('Ver métricas')
                    ->icon('heroicon-o-chart-bar')
                    ->url(fn ($record) => $record->metric
                        ? ContentMetricResource::getUrl('edit', [
                            'record' => $record->metric,
                        ])
                        : null
                    )
                    ->visible(fn ($record) => $record->metric !== null),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
