<?php

namespace App\Filament\Resources\Hypotheses\RelationManagers;

use App\Models\Hypothesis;
use App\Models\HypothesisTest;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
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
                Action::make('registerLabPost')
                    ->label(fn ($record) => $record->labPost()->exists()
                        ? 'Ver publicación'
                        : 'Registrar publicación'
                    )
                    ->icon(fn ($record) => $record->labPost()->exists()
                        ? 'heroicon-o-eye'
                        : 'heroicon-o-plus'
                    )
                    ->fillForm(function (HypothesisTest $record): array {
                        $labPost = $record->labPost;

                        return $labPost ? [
                            'title' => $labPost->title,
                            'caption' => $labPost->caption,
                            'platform' => $labPost->platform,
                            'published_at' => $labPost->published_at,
                            'notes' => $labPost->notes,
                        ] : [];
                    })
                    ->schema([
                        TextInput::make('title')
                            ->label('Título'),
                        Textarea::make('caption')
                            ->label('Descripción'),
                        TextInput::make('platform')
                            ->label('Plataforma'),
                        DateTimePicker::make('published_at')
                            ->label('Publicado')
                            ->dateMex(),
                        Textarea::make('notes')
                            ->label('Notas')
                    ])
                    ->action(function (HypothesisTest $record, array $data) {
                        $record->labPost()->create($data);
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
