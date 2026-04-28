<?php

namespace App\Filament\Resources\Hypotheses\RelationManagers;

use App\Filament\Resources\ContentMetrics\ContentMetricResource;
use App\Models\Hypothesis;
use App\Models\HypothesisTest;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
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
                Textarea::make('change_description')
                    ->label(function ($livewire) {
                        $variable = $livewire->ownerRecord->variable === 'other'
                            ? $livewire->ownerRecord->variable_custom
                            : Hypothesis::VARIABLE_LABELS[$livewire->ownerRecord->variable];

                        return "Variación de {$variable}";
                    })
                    ->required()
                    ->columnSpanFull()
                    ->helperText('Describe cómo cambiaste esta variable.'),
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
                TextColumn::make('hypothesis.variable')
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
                            // VARIABLE
                            'variable_variant' => $labPost->variable_variant,
                            'notes' => $labPost->notes,
                            // DEETAILS
                            'caption' => $labPost->caption,
                            'platform' => $labPost->platform,
                            'same_format' => (bool) $labPost->same_format,
                            'format_used' => $labPost->format_used,
                            'published_at' => $labPost->published_at,
                        ] : [];
                    })
                    ->schema([
                        Tabs::make('LabPostTabs')
                            ->tabs([
                                Tab::make('Variable')
                                    ->schema([
                                        TextInput::make('variable_variant')
                                            ->label('Variación')
                                            ->required(),

                                        Textarea::make('notes')
                                            ->label('Notas')
                                            ->columnSpanFull(),
                                    ]),

                                Tab::make('Detalles')
                                    ->schema([
                                        Textarea::make('caption')
                                            ->label('Descripción usada')
                                            ->columnSpanFull(),

                                        TextInput::make('platform')
                                            ->label('Plataforma'),

                                        Checkbox::make('same_format')
                                            ->label('Usé el mismo formato')
                                            ->default(true)
                                            ->live(),

                                        TextInput::make('format_used')
                                            ->label('Formato usado')
                                            ->placeholder('Ej: reel, carrusel, imagen estática')
                                            ->visible(fn ($get) => ! $get('same_format'))
                                            ->required(fn ($get) => ! $get('same_format')),

                                        DateTimePicker::make('published_at')
                                            ->label('Publicado')
                                            ->dateMex(),
                                    ]),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->modalFooterActions(function (Action $action) {
                        return [
                            $action->getModalSubmitAction(),
                            $action->getModalCancelAction(),

                            Action::make('viewMetrics')
                                ->label('Ver métricas')
                                ->icon('heroicon-o-chart-bar')
                                ->color('gray')
                                ->visible(fn ($record) => $record->labPost?->metric !== null)
                                ->url(fn ($record) => ContentMetricResource::getUrl('edit', [
                                    'record' => $record->labPost->metric,
                                ]))
                                ->extraAttributes([
                                    'style' => 'margin-left: auto !important;',
                                ]),

                        ];
                    })
                    ->action(function (HypothesisTest $record, array $data) {
                        $record->labPost()->updateOrCreate(
                            ['hypothesis_test_id' => $record->id],
                            $data
                        );
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
