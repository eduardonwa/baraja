<?php

namespace App\Filament\Resources\RotationCycleItems\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RotationCycleItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('idea_id')
                    ->relationship('idea', 'title')
                    ->required(),
                Toggle::make('done')
                    ->required(),
                DateTimePicker::make('completed_at'),
            ]);
    }
}
