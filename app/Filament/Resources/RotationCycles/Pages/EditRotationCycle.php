<?php

namespace App\Filament\Resources\RotationCycles\Pages;

use App\Filament\Resources\RotationCycles\RotationCycleResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRotationCycle extends EditRecord
{
    protected static string $resource = RotationCycleResource::class;

    public function getTitle(): string
    {
        return 'Editar lote';
    }

    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Guardar cambios');
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Cancelar');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Eliminar'),
        ];
    }
}
