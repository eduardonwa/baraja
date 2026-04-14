<?php

namespace App\Filament\Resources\RotationCycles\RelationManagers;

use App\Models\Idea;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('idea_id')
                    ->label('Idea')
                    ->options(function ($record) {
                        if (!$record) {
                            return [];
                        }

                        return Idea::query()
                            ->where('hook_id', $record->hook_id)
                            ->orderBy('title')
                            ->pluck('title', 'id')
                            ->toArray();
                    })
                    ->searchable()
                    ->preload()
                    ->nullable(),
                Toggle::make('done')
                    ->label('Done')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('position')
                    ->sortable(),
                TextColumn::make('hook.name')
                    ->label('Hook')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('idea.title')
                    ->label('Idea')
                    ->placeholder('-')
                    ->searchable(),
                IconColumn::make('done')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('completed_at')
                    ->dateTime()
                    ->placeholder('-'),
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
