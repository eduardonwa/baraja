<?php

namespace App\Filament\Resources\Hypotheses\Pages;

use App\Filament\Resources\Hypotheses\HypothesisResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHypotheses extends ListRecords
{
    protected static string $resource = HypothesisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
