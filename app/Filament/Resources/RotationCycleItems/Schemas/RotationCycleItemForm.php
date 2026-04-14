<?php

namespace App\Filament\Resources\RotationCycleItems\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RotationCycleItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('rotation_cycle_id')
                    ->required()
                    ->numeric(),
                Select::make('hook_id')
                    ->relationship('hook', 'name')
                    ->required(),
                Select::make('idea_id')
                    ->relationship('idea', 'title')
                    ->required(),
                TextInput::make('position')
                    ->required()
                    ->numeric(),
                Toggle::make('done')
                    ->required(),
                DateTimePicker::make('completed_at'),
            ]);
    }
}
