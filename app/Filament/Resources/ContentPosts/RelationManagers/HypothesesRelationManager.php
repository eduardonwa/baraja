<?php

namespace App\Filament\Resources\ContentPosts\RelationManagers;

use App\Filament\Resources\Hypotheses\HypothesisResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class HypothesesRelationManager extends RelationManager
{
    protected static string $relationship = 'hypotheses';

    protected static ?string $relatedResource = HypothesisResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()
                    ->openUrlInNewTab()
                    ->url(fn () => HypothesisResource::getUrl('create', parameters: [
                        'source_content_post_id' => $this->ownerRecord->id,
                    ]))
            ]);
    }
}
