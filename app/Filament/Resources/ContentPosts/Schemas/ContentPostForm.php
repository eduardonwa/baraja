<?php

namespace App\Filament\Resources\ContentPosts\Schemas;

use App\Filament\Resources\RotationCycles\RotationCycleResource;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class ContentPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('rotation_cycle_item_id')
                    ->default(fn () => request()->query('rotation_cycle_item_id'))
                    ->required(),
                TextEntry::make('back_to_cycle')
                    ->label('Origen')
                    ->state(function ($record) {
                        $item = $record?->rotationCycleItem?->loadMissing(['cycle', 'hook']);

                        if (! $item || ! $item->cycle) {
                            return '-';
                        }

                        return new HtmlString(sprintf(
                            '<a href="%s" class="text-primary-600 underline">#%s %s</a>',
                            \App\Filament\Resources\RotationCycles\RotationCycleResource::getUrl('edit', [
                                'record' => $item->cycle,
                            ]),
                            e($item->position),
                            e($item->hook?->name ?? '-')
                        ));
                    }),
                TextInput::make('title'),
                TextInput::make('type'),
                TextInput::make('format'),
                Textarea::make('caption')
                    ->columnSpanFull(),
                TextInput::make('platform')
                    ->required(),
                DateTimePicker::make('published_at'),
                Textarea::make('hashtags')
                    ->columnSpanFull(),
                Textarea::make('people_tagged_and_dmd')
                    ->columnSpanFull(),
                TextInput::make('external_post_id'),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
