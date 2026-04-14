<?php

namespace App\Filament\Resources\ContentMetrics\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContentMetricInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('rotationCycleItem.id')
                    ->label('Rotation cycle item'),
                TextEntry::make('title')
                    ->placeholder('-'),
                TextEntry::make('post_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('creation_time_hours')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('sourced_from')
                    ->placeholder('-'),
                TextEntry::make('type')
                    ->placeholder('-'),
                TextEntry::make('style')
                    ->placeholder('-'),
                ImageEntry::make('cover_image')
                    ->placeholder('-'),
                TextEntry::make('people_tagged_and_dmd')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('hashtags_used')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('accounts_reached')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('profile_visits')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('follows')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('likes')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('comments')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('shares')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('saves')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('reposts')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('views')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
