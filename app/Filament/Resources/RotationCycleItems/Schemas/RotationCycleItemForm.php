<?php

namespace App\Filament\Resources\RotationCycleItems\Schemas;

use App\Filament\Resources\RotationCycles\RotationCycleResource;
use App\Models\RotationCycleItem;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class RotationCycleItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('idea_id')
                    ->relationship('idea', 'title')
                    ->required(),
                TextEntry::make('set')
                    ->inlineLabel()
                    ->state(function (?RotationCycleItem $record) {
                        $record?->loadMissing('cycle');

                        $cycle = $record?->cycle;

                        if (! $cycle) {
                            return '-';
                        }

                        return new HtmlString(
                            sprintf(
                                '<a href="%s" class="text-primary-600 underline">%s</a>',
                                RotationCycleResource::getUrl('edit', ['record' => $cycle]),
                                e($cycle->name)
                            )
                        );
                    })
            ]);
    }
}
