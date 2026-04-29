<?php

namespace App\Filament\Resources\ContentPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\View;
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
                        Section::make()
                            ->columns(2)
                            ->schema([
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

                            ])->columnSpanFull(),

                            // Info + Metadata
                        Grid::make(1)
                            ->extraAttributes(['style' => 'padding: 1rem; border: 1px solid var(--gray-800); border-radius: .8rem;'])
                            ->schema([
                                // INFO
                                View::make('filament.components.header')
                                    ->viewData([
                                        'title' => 'Detalles'
                                    ])
                                    ->columnSpanFull(),
                                TextInput::make('title')
                                    ->label('Título'),
                                Textarea::make('caption')
                                    ->columnSpanFull(),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('type')
                                            ->label('Tipo de publicación'),
                                        TextInput::make('format')
                                            ->label('Formato'),
                                    ]),
                            ]),

                        Grid::make(1)
                            ->extraAttributes(['style' => 'padding: 1rem; border: 1px solid var(--gray-800); border-radius: .8rem;'])
                            ->schema([
                                // META
                                View::make('filament.components.header')
                                    ->viewData([
                                        'title' => 'Configuración'
                                    ])
                                    ->columnSpanFull(),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('external_post_id')
                                            ->label('ID externo'),
                                        DateTimePicker::make('published_at')
                                            ->label('Publicado')
                                            ->dateMex()
                                    ]),
                                Textarea::make('hashtags')
                                    ->columnSpanFull(),
                                Textarea::make('people_tagged_and_dmd')
                                    ->label('Personas etiquetadas y contactadas')
                                    ->columnSpanFull(),
                                ]),
                                
                        Textarea::make('notes')
                            ->label('Notas')
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
            ]);
    }
}
