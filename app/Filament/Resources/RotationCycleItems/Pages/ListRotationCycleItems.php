<?php

namespace App\Filament\Resources\RotationCycleItems\Pages;

use App\Filament\Resources\RotationCycleItems\RotationCycleItemResource;
use Filament\Resources\Pages\ListRecords;

class ListRotationCycleItems extends ListRecords
{
    protected static string $resource = RotationCycleItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
