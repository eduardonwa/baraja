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
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('platform_id')
                    ->label('Plataforma')
                    ->relationship('platform', 'name')
                    ->preload()
                    ->required(),
                TextInput::make('handle')
                    ->label('Nombre de usuario')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('name')
                    ->maxLength(255)
                    ->label('Nombre'),
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
