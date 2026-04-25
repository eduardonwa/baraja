<?php

namespace App\Filament\Resources\Hypotheses\Pages;

use App\Filament\Resources\Hypotheses\HypothesisResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHypothesis extends ViewRecord
{
    protected static string $resource = HypothesisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
