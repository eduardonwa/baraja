<?php

namespace App\Filament\Resources\RotationCycleItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RotationCycleItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cycle.name')
                    ->label('Set')
                    ->sortable(),
                TextColumn::make('position')
                    ->label('Posición')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('hook.name')
                    ->searchable(),
                TextColumn::make('idea.title')
                    ->searchable(),
                IconColumn::make('done')
                    ->label('Estado')
                    ->boolean(),
                TextColumn::make('completed_at')
                    ->label('Finalizado el')
                    ->date('j M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
