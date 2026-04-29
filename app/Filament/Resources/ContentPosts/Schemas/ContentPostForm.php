<?php

namespace App\Filament\Resources\ContentPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
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

                Grid::make(2)
                    ->schema([
                        // Header + Account
        
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
                            })
                            ->columnSpan(1),
        
                        Select::make('account_id')
                            ->label('Cuenta')
                            ->relationship(
                                'account',
                                'handle',
                                fn ($query) => $query->where('user_id', auth()->id())
                            )
                            ->getOptionLabelFromRecordUsing(fn ($record) =>
                                "{$record->platform->name} — {$record->handle}"
                            )
                            ->preload()
                            ->searchable()
                            ->required()
                            ->columnSpan(1),

                            // Info + Metadata
                        Grid::make(1)
                            ->schema([
                                // INFO
                                TextInput::make('title')
                                    ->label('Título'),
                                TextInput::make('type')
                                    ->label('Tipo de publicación'),
                                TextInput::make('format')
                                    ->label('Formato'),
                                Textarea::make('caption')
                                    ->columnSpanFull(),
                            ]),

                        Grid::make(1)
                            ->schema([
                                // META
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
                            ])
                        
                    ])->columnSpanFull(),
            ]);
    }
}
