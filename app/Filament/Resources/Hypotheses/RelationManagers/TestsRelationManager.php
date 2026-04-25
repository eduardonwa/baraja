<?php

namespace App\Filament\Resources\Hypotheses\RelationManagers;

use App\Models\Hypothesis;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TestsRelationManager extends RelationManager
{
    protected static string $relationship = 'tests';

    protected static ?string $title = 'Señales';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('changed_variable')
                    ->default(fn ($livewire) => $livewire->ownerRecord->variable)
                    ->required(),
                Textarea::make('change_description')
                    ->label('Variación')
                    ->required()
                    ->columnSpanFull()
                    ->helperText('Descripción del cambio. Ej: "texto más corto"'),
                Select::make('result')
                    ->label('Resultado')
                    ->options([
                        'pending' => '— Pendiente',
                        'confirmed' => '⬆ Confirmado',
                        'rejected' => '⬇ Rechazado'
                    ])
                    ->default('pending')
                    ->required(),
                TextInput::make('signal_strength')
                    ->label('Fuerza de la señal')
                    ->numeric()
                    ->helperTexT('Del 1 al 100, qué tan bien o mal fue el resultado. '),
                Textarea::make('observations')
                    ->label('Observaciones')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('change_description')
            ->columns([
                TextColumn::make('changed_variable')
                    ->label('Variable')
                    ->formatStateUsing(fn ($state) =>
                        Hypothesis::VARIABLE_LABELS[$state] ?? $state
                    )
                    ->badge(),
                TextColumn::make('result')
                    ->label('Resultado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'rejected' => 'danger',
                        'pending' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('signal_strength')
                    ->label('Señal de fuerza')
                    ->numeric()
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
            ->headerActions([
                CreateAction::make()
                    ->label('Nueva señal'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
