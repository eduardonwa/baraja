<?php

namespace App\Filament\Resources\Hypotheses\Schemas;

use App\Filament\Resources\ContentPosts\ContentPostResource;
use App\Models\Hypothesis;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class HypothesisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(4)
                    ->schema([
                        ViewField::make('experiment_signals')
                            ->label('')
                            ->dehydrated(false)
                            ->view('filament.components.experiment-signals')
                            ->viewData(fn ($record) => [
                                'positive' => $record?->fresh()?->positive_signals_count ?? 0,
                                'negative' => $record?->fresh()?->failed_tests_count ?? 0,
                                'confidence' => $record?->fresh()?->confidence_score ?? 0,
                            ])
                            ->columnSpan(2),

                        ViewField::make('experiment_variable')
                            ->dehydrated(false)
                            ->view('filament.components.experiment-variable')
                            ->viewData(fn ($record) => [
                                'variable' => $record?->variable ?? '—',
                                'variableCustom' => $record?->variable_custom ?? '—',
                                'labels' => Hypothesis::VARIABLE_LABELS
                            ])
                            ->visible(fn (string $operation) => $operation === 'edit')
                            ->columnSpan(1),

                        ViewField::make('source_post')
                            ->dehydrated(false)
                            ->label('')
                            ->view('filament.components.source-post')
                            ->viewData(fn ($record) => [
                                'post' => $record?->sourceContentPost,
                            ])->columnSpan(1),

                        Group::make([
                            TextEntry::make('variable_label')
                                ->hiddenLabel()
                                ->extraAttributes([
                                    'style' => 'text-align: center;'
                                ])
                                ->state('Variable'),

                            Select::make('variable')
                                ->hiddenLabel()
                                ->options(Hypothesis::VARIABLE_LABELS)
                                ->live()
                                ->required(),

                            TextInput::make('variable_custom')
                                ->label('Especifica la variable')
                                ->visible(fn ($get) => $get('variable') === 'other')
                                ->required(fn ($get) => $get('variable') === 'other'),
                        ])
                        ->extraAttributes([
                            'class' => 'rounded-xl border border-white/10 bg-white/[0.03] p-5 h-full flex flex-col items-center justify-center gap-3',
                        ])
                        ->visible(fn (string $operation) => $operation === 'create')
                        ->columnSpan(1),
                    ])->columnSpanFull(),

/*                     ViewField::make('source_post')
                        ->dehydrated(false)
                        ->label('')
                        ->view('filament.components.source-post')
                        ->viewData(fn ($record) => [
                            'post' => $record?->sourceContentPost,
                        ])
                        ->columnSpanFull(), */

                    Grid::make(3)
                        ->schema([
                            Grid::make(1)
                                ->schema([
                                    Select::make('status')
                                        ->label('Estado')
                                        ->options([
                                            'observing' => 'Observando',
                                            'testing' => 'Probando',
                                            'promising' => 'Prometedor',
                                            'reliable' => 'Confiable',
                                            'discarded' => 'Descartado',
                                        ])
                                        ->default('observing')
                                        ->required(),
                                    Textarea::make('notes')
                                        ->label('Notas')
                                        ->rows(4)
                                        ->autosize()
                                        ->columnSpanFull(),
                                ])->columnSpan(1),
                            Grid::make(1)
                                ->extraAttributes(['style' => 'padding-inline: 1rem;'])
                                ->schema([
                                    TextInput::make('title')
                                        ->label('Título'),

                                    Textarea::make('insight')
                                        ->label('Observación')
                                        ->rows(4)
                                        ->autosize()
                                        ->columnSpanFull(),
                                ])
                                ->columnSpan(2),
                        ])->columnSpanFull(),

                Hidden::make('source_content_post_id')
                    ->default(fn () => request()->query('source_content_post_id'))
                    ->dehydrated()
            ]);
    }
}
