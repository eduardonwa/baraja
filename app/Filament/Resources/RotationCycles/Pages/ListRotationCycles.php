<?php

namespace App\Filament\Resources\RotationCycles\Pages;

use App\Filament\Resources\RotationCycles\RotationCycleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRotationCycles extends ListRecords
{
    protected static string $resource = RotationCycleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
