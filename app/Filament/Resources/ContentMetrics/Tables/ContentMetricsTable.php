<?php

namespace App\Filament\Resources\ContentMetrics\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContentMetricsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rotationCycleItem.id')
                    ->searchable(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('post_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('creation_time_hours')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sourced_from')
                    ->searchable(),
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('style')
                    ->searchable(),
                ImageColumn::make('cover_image'),
                TextColumn::make('accounts_reached')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('profile_visits')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('follows')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('likes')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('comments')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('shares')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('saves')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('reposts')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('views')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
