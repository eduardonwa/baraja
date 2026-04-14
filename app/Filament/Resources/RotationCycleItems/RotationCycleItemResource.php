<?php

namespace App\Filament\Resources\RotationCycleItems;

use App\Filament\Resources\RotationCycleItems\Pages\CreateRotationCycleItem;
use App\Filament\Resources\RotationCycleItems\Pages\EditRotationCycleItem;
use App\Filament\Resources\RotationCycleItems\Pages\ListRotationCycleItems;
use App\Filament\Resources\RotationCycleItems\Schemas\RotationCycleItemForm;
use App\Filament\Resources\RotationCycleItems\Tables\RotationCycleItemsTable;
use App\Models\RotationCycleItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RotationCycleItemResource extends Resource
{
    protected static ?string $model = RotationCycleItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return RotationCycleItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RotationCycleItemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRotationCycleItems::route('/'),
            'create' => CreateRotationCycleItem::route('/create'),
            'edit' => EditRotationCycleItem::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
