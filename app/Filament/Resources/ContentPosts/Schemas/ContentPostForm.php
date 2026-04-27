<?php

namespace App\Filament\Resources\ContentPosts\Schemas;

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
                            '<a href="%s" target="_blank" rel="noopener noreferrer" class="text-primary-600 underline">#%s %s</a>',
                            \App\Filament\Resources\RotationCycles\RotationCycleResource::getUrl('edit', [
                                'record' => $item->cycle,
                            ]),
                            e($item->position),
                            e($item->hook?->name ?? '-')
                        ));
                    }),
                TextInput::make('title')
                    ->label('Título'),
                TextInput::make('type')
                    ->label('Tipo de publicación'),
                TextInput::make('format')
                    ->label('Formato'),
                Textarea::make('caption')
                    ->columnSpanFull(),
                TextInput::make('platform')
                    ->label('Plataforma')
                    ->required(),
                DateTimePicker::make('published_at')
                    ->label('Publicado')
                    ->dateMex(),
                Textarea::make('hashtags')
                    ->columnSpanFull(),
                Textarea::make('people_tagged_and_dmd')
                    ->label('Personas etiquetadas y dmd')
                    ->columnSpanFull(),
                TextInput::make('external_post_id'),
                Textarea::make('notes')
                    ->label('Notas')
                    ->columnSpanFull(),
            ]);
    }
}
