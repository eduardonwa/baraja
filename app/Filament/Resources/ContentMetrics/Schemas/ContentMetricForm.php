<?php

namespace App\Filament\Resources\ContentMetrics\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
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
                                'carousel' => 'Carousel'
                            ]),
                        Select::make('format')
                            ->options([
                                'meme' => 'Meme',
                                'updates' => 'Updates',
                                'story' => 'Story'
                            ]),
                        Textarea::make('hashtags_used')
                            ->columnSpanFull(),
                        Textarea::make('people_tagged_and_dmd')
                            ->columnSpanFull(),
                    ]),

                Section::make('Metrics')
                    ->schema([
                        TextInput::make('profile_visits')
                            ->numeric(),
                        TextInput::make('follows')
                            ->label('New followers')
                            ->helperText('The number of new followers you have gained from this post.')
                            ->numeric(),
                        TextInput::make('likes')
                            ->numeric(),
                        TextInput::make('comments')
                            ->numeric(),
                        TextInput::make('shares')
                            ->numeric(),
                        TextInput::make('saves')
                            ->numeric(),
                        TextInput::make('reposts')
                            ->numeric(),
                        TextInput::make('views')
                            ->numeric(),
                    ]),
                    
                Select::make('rotation_cycle_item_id')
                    ->relationship('rotationCycleItem', 'id')
                    ->required()
                    ->hidden(),
            ]);
    }
}
