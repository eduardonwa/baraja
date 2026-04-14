<?php

namespace App\Filament\Resources\RotationCycles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RotationCycleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
                DateTimePicker::make('generated_at'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
