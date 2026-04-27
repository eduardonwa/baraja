<?php

namespace App\Filament\Resources\Hypotheses\Pages;

use App\Filament\Resources\Hypotheses\HypothesisResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHypothesis extends CreateRecord
{
    protected static string $resource = HypothesisResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (blank($data['source_content_post_id'] ?? null)) {
            $data['source_content_post_id'] = request()->query('source_content_post_id');
        }

        return $data;
    }
}
