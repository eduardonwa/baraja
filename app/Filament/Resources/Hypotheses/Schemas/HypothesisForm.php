<?php

namespace App\Filament\Resources\Hypotheses\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HypothesisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('source_post')
                    ->label('Publicación')
                    ->color('gray')
                    ->state(fn ($record) => $record?->sourceContentPost?->title ?? '-'),
                TextInput::make('title')
                    ->label('Título'),
                Textarea::make('insight')
                    ->label('Observación')
                    ->columnSpanFull(),

                TextEntry::make('variable_label')
                    ->label('Variable')
                    ->color('gray'),
                    
                Select::make('status')
                    ->options([
                        'observing' => 'Observando',
                        'testing' => 'Probando',
                        'promising' => 'Prometedor',
                        'reliable' => 'Confiable',
                        'discarded' => 'Descartado',
                    ])
                    ->default('observing')
                    ->required(),

                TextEntry::make('positive_signals_count')
                    ->label('Señales positivas')
                    ->color('gray'),
                TextEntry::make('failed_tests_count')
                    ->label('Señales negativas')
                    ->color('gray'),

                TextEntry::make('confidence_score')
                    ->label('Nivel de confianza')
                    ->state(fn ($record) => $record->fresh()->confidence_score ?? 0)
                    ->formatStateUsing(fn ($state) => "{$state}%")
                    ->color('gray')
                    ->numeric()
                    ->suffix('%')
                    ->helperText('Se calcula automáticamente segun la señal de los tests'),

                Textarea::make('notes')
                    ->label('Notas')
                    ->columnSpanFull(),

                Hidden::make('source_content_post_id')
            ]);
    }
}
