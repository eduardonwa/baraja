<?php

namespace App\Filament\Resources\ContentMetrics\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ContentMetricForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Post content')
                    ->schema([
                        TextInput::make('title'),

                        Select::make('type')
                            ->options([
                                'image' => 'Image',
                                'reel' => 'Reel',
                                'carousel' => 'Carousel',
                            ]),

                        Select::make('format')
                            ->options([
                                'meme' => 'Meme',
                                'updates' => 'Updates',
                                'story' => 'Story',
                            ]),

                        Textarea::make('hashtags_used')
                            ->columnSpanFull(),

                        Textarea::make('people_tagged_and_dmd')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Metrics snapshots')
                    ->schema([
                        Tabs::make('MetricsTabs')
                            ->tabs([
                                Tab::make('Initial impact (24h)')
                                    ->schema([
                                        TextInput::make('views_24h')
                                            ->label('Views')
                                            ->numeric(),
                                        TextInput::make('profile_visits_24h')
                                            ->label('Profile visits')
                                            ->numeric(),
                                        TextInput::make('follows_24h')
                                            ->label('New followers')
                                            ->numeric(),
                                        TextInput::make('likes_24h')
                                            ->label('Likes')
                                            ->numeric(),
                                        TextInput::make('comments_24h')
                                            ->label('Comments')
                                            ->numeric(),
                                        TextInput::make('shares_24h')
                                            ->label('Shares')
                                            ->numeric(),
                                        TextInput::make('saves_24h')
                                            ->label('Saves')
                                            ->numeric(),
                                        TextInput::make('reposts_24h')
                                            ->label('Reposts')
                                            ->numeric(),
                                    ])
                                    ->columns(2),

                                Tab::make('Validation phase (3d)')
                                    ->schema([
                                        TextInput::make('views_72h')
                                            ->label('Views')
                                            ->numeric(),
                                        TextInput::make('profile_visits_72h')
                                            ->label('Profile visits')
                                            ->numeric(),
                                        TextInput::make('follows_72h')
                                            ->label('New followers')
                                            ->numeric(),
                                        TextInput::make('likes_72h')
                                            ->label('Likes')
                                            ->numeric(),
                                        TextInput::make('comments_72h')
                                            ->label('Comments')
                                            ->numeric(),
                                        TextInput::make('shares_72h')
                                            ->label('Shares')
                                            ->numeric(),
                                        TextInput::make('saves_72h')
                                            ->label('Saves')
                                            ->numeric(),
                                        TextInput::make('reposts_72h')
                                            ->label('Reposts')
                                            ->numeric(),
                                    ])
                                    ->columns(2),

                                Tab::make('Final performance (7d)')
                                    ->schema([
                                        TextInput::make('views_7d')
                                            ->label('Views')
                                            ->numeric(),
                                        TextInput::make('profile_visits_7d')
                                            ->label('Profile visits')
                                            ->numeric(),
                                        TextInput::make('follows_7d')
                                            ->label('New followers')
                                            ->numeric(),
                                        TextInput::make('likes_7d')
                                            ->label('Likes')
                                            ->numeric(),
                                        TextInput::make('comments_7d')
                                            ->label('Comments')
                                            ->numeric(),
                                        TextInput::make('shares_7d')
                                            ->label('Shares')
                                            ->numeric(),
                                        TextInput::make('saves_7d')
                                            ->label('Saves')
                                            ->numeric(),
                                        TextInput::make('reposts_7d')
                                            ->label('Reposts')
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                            ])
                            ->columnSpanFull(),
                    ]),

                Select::make('rotation_cycle_item_id')
                    ->relationship('rotationCycleItem', 'id')
                    ->required()
                    ->hidden(),
            ]);
    }
}