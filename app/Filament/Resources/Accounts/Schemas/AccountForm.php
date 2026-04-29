<?php

namespace App\Filament\Resources\Accounts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('platform_id')
                    ->label('Plataforma')
                    ->relationship('platform', 'name')
                    ->preload()
                    ->required(),
                TextInput::make('handle')
                    ->label('Usuario en plataforma')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('name')
                    ->label('Nombre de la cuenta')
                    ->maxLength(255),
                TextInput::make('niche')
                    ->label('Nicho')
                    ->maxLength(255),
                Toggle::make('is_default')
                    ->label('Predeterminada')
                    ->required(),
                Toggle::make('is_active')
                    ->label('Activa')
                    ->default(true)
                    ->required(),
            ]);
    }
}
