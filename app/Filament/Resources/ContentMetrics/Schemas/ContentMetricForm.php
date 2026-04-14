<?php

namespace App\Filament\Resources\ContentMetrics\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ContentMetricForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('rotation_cycle_item_id')
                    ->relationship('rotationCycleItem', 'id')
                    ->required(),
                TextInput::make('title'),
                DatePicker::make('post_date'),
                TextInput::make('creation_time_hours')
                    ->numeric(),
                TextInput::make('sourced_from'),
                TextInput::make('type'),
                TextInput::make('style'),
                FileUpload::make('cover_image')
                    ->image(),
                Textarea::make('people_tagged_and_dmd')
                    ->columnSpanFull(),
                Textarea::make('hashtags_used')
                    ->columnSpanFull(),
                TextInput::make('accounts_reached')
                    ->numeric(),
                TextInput::make('profile_visits')
                    ->numeric(),
                TextInput::make('follows')
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
            ]);
    }
}
