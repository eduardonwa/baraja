<?php

namespace App\Filament\Resources\Hypotheses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HypothesisInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('sourceContentPost.title')
                    ->label('Source content post'),
                TextEntry::make('title')
                    ->placeholder('-'),
                TextEntry::make('insight')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('variable_label')
                    ->badge(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('positive_signals_count')
                    ->numeric(),
                TextEntry::make('failed_tests_count')
                    ->numeric(),
                TextEntry::make('confidence_score')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
