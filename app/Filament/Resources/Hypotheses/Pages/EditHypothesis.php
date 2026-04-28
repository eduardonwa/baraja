<?php

namespace App\Filament\Resources\Hypotheses\Pages;

use App\Filament\Resources\Hypotheses\HypothesisResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditHypothesis extends EditRecord
{
    protected static string $resource = HypothesisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
