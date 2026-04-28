<?php

namespace App\Filament\Resources\ContentMetrics\Schemas;

use App\Models\ContentPost;
use App\Models\LabPost;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class ContentMetricForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('post_header')
                    ->hiddenLabel()
                    ->state(function ($record) {
                        $metricable = $record->metricable;

                        $title = match (true) {
                            $metricable instanceof ContentPost => $metricable->title ?? 'Publicación',
                            $metricable instanceof LabPost => $metricable->variable_variant ?? 'Lab post',
                            default => 'Publicación',
                        };

                        $description = match (true) {
                            $metricable instanceof ContentPost => 'Mide el impacto, validación y rendimiento de tu publicación.',
                            $metricable instanceof LabPost => 'Mide el resultado del experimento y la fuerza de esta variación.',
                            default => 'Mide el impacto, validación y rendimiento.',
                        };

                        return new HtmlString('
                            <div class="space-y-1">
                                <div class="text-base font-medium text-white">
                                    ' . e($title) . '
                                </div>
                                <div class="text-sm" style="color: var(--gray-400);">
                                    ' . e($description) . '
                                </div>
                            </div>
                        ');
                    }),
                    
                Tabs::make('MetricsTabs')
                    ->extraAttributes([
                        'class' => 'metrics-tabs',
                    ])
                    ->tabs([
                        Tab::make('Impacto inicial (24h)')
                            ->schema([
                                Section::make('Conversiones')
                                    ->description('Mide alcance y acciones reales')
                                    ->schema([
                                        TextInput::make('views_24h')
                                            ->label('Vistas')
                                            ->numeric(),
                                        TextInput::make('profile_visits_24h')
                                            ->label('Visitas al perfil')
                                            ->numeric(),
                                        TextInput::make('follows_24h')
                                            ->label('Nuevos seguidores')
                                            ->numeric()
                                    ])
                                    ->contained(false),
                                Section::make('Interacciones')
                                    ->description('Mide respuesta social del contenido')
                                    ->schema([
                                        TextInput::make('likes_24h')
                                            ->label('Me gusta')
                                            ->numeric(),
                                        TextInput::make('comments_24h')
                                            ->label('Comentarios')
                                            ->numeric(),
                                        TextInput::make('shares_24h')
                                            ->label('Compartidos')
                                            ->numeric(),
                                        TextInput::make('saves_24h')
                                            ->label('Guardados')
                                            ->numeric(),
                                        TextInput::make('reposts_24h')
                                            ->label('Reposts')
                                            ->numeric(),
                                    ])
                                    ->contained(false),
                            ])
                            ->columns(2),

                        Tab::make('Fase de validación (3d)')
                            ->schema([
                                Section::make('Conversiones')
                                    ->description('Mide alcance y acciones reales')
                                    ->schema([
                                        TextInput::make('views_3d')
                                            ->label('Vistas')
                                            ->numeric(),
                                        TextInput::make('profile_visits_3d')
                                            ->label('Visitas al perfil')
                                            ->numeric(),
                                        TextInput::make('follows_3d')
                                            ->label('Nuevos seguidores')
                                            ->numeric()
                                    ])
                                    ->contained(false),
                                Section::make('Interacciones')
                                    ->description('Mide respuesta social del contenido')
                                    ->schema([
                                        TextInput::make('likes_3d')
                                            ->label('Me gusta')
                                            ->numeric(),
                                        TextInput::make('comments_3d')
                                            ->label('Comentarios')
                                            ->numeric(),
                                        TextInput::make('shares_3d')
                                            ->label('Compartidos')
                                            ->numeric(),
                                        TextInput::make('saves_3d')
                                            ->label('Guardados')
                                            ->numeric(),
                                        TextInput::make('reposts_3d')
                                            ->label('Reposts')
                                            ->numeric(),
                                    ])
                                    ->contained(false),
                            ])
                            ->columns(2),

                        Tab::make('Rendimiento final (7d)')
                            ->schema([
                                Section::make('Conversiones')
                                    ->description('Mide alcance y acciones reales')
                                    ->schema([
                                        TextInput::make('views_7d')
                                            ->label('Vistas')
                                            ->numeric(),
                                        TextInput::make('profile_visits_7d')
                                            ->label('Visitas al perfil')
                                            ->numeric(),
                                        TextInput::make('follows_7d')
                                            ->label('Nuevos seguidores')
                                            ->numeric()
                                    ])
                                    ->contained(false),
                                Section::make('Interacciones')
                                    ->description('Mide respuesta social del contenido')
                                    ->schema([
                                        TextInput::make('likes_7d')
                                            ->label('Me gusta')
                                            ->numeric(),
                                        TextInput::make('comments_7d')
                                            ->label('Comentarios')
                                            ->numeric(),
                                        TextInput::make('shares_7d')
                                            ->label('Compartidos')
                                            ->numeric(),
                                        TextInput::make('saves_7d')
                                            ->label('Guardados')
                                            ->numeric(),
                                        TextInput::make('reposts_7d')
                                            ->label('Reposts')
                                            ->numeric(),
                                    ])
                                    ->contained(false),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpanFull()                
            ]);
    }
}