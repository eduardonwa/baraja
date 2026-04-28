<?php

namespace App\Filament\Resources\ContentMetrics\Tables;

use App\Filament\Resources\ContentMetrics\ContentMetricResource;
use App\Models\ContentPost;
use App\Models\LabPost;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContentMetricsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('metricable_title')
                    ->label('Publicación')
                    ->searchable(query: function ($query, $search) {
                        $query->whereHasMorph(
                            'metricable',
                            [ContentPost::class, LabPost::class],
                            function ($q) use ($search) {
                                $q->where(function ($sub) use ($search) {
                                    $sub->where('title', 'like', "%{$search}%")
                                        ->orWhere('variable_variant', 'like', "%{$search}%");
                                });
                            }
                        );
                    })
                    ->state(fn ($record) => match (true) {
                        $record->metricable instanceof ContentPost => $record->metricable->title,
                        $record->metricable instanceof LabPost => $record->metricable->variable_variant ?? $record->metricable->caption,
                        default => '-',
                    }),

                TextColumn::make('metricable.platform')
                    ->label('Plataforma')
                    ->searchable(),
                TextColumn::make('metricable_type')
                    ->label('Tipo')
                    ->badge()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        ContentPost::class => 'Publicación',
                        LabPost::class => 'Publicación',
                        default => 'Desconocido'
                    })
                    ->color(fn ($state) => match ($state) {
                        ContentPost::class => 'success',
                        LabPost::class => 'info',
                        default => 'gray'
                    }),
                TextColumn::make('created_at')
                    ->label('Fecha creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Fecha actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->modalWidth('5xl')
                    ->modalFooterActions([
                        Action::make('edit')
                            ->label('Editar')
                            ->icon('heroicon-o-pencil')
                            ->url(fn ($record) => ContentMetricResource::getUrl('edit', [
                                'record' => $record
                            ]))
                    ])
                    ->schema([
                        Section::make()
                            ->schema([
                                TextEntry::make('metricable_title')
                                    ->label('Título')
                                    ->color('gray')
                                    ->state(fn ($record) => match (true) {
                                        $record->metricable instanceof ContentPost => $record->metricable->title,
                                        $record->metricable instanceof LabPost => $record->metricable->variable_variant
                                            ?? $record->metricable->caption
                                            ?? 'Lab post',
                                        default => '-',
                                    }),
                                TextEntry::make('metricable.platform')
                                    ->label('Plataforma')
                                    ->color('gray'),
                                TextEntry::make('created_at')
                                    ->label('Fecha de creación')
                                    ->color('gray')
                                    ->formatStateUsing(fn ($state) =>
                                        $state
                                            ? Carbon::parse($state)->translatedFormat('j F Y')
                                            : null
                                    ),
                                Tabs::make('Métricas')
                                    ->tabs([
                                        Tab::make('Impacto inicial (24h)')
                                            ->schema([
                                                TextEntry::make('views_24h')->label('Vistas')->color('gray'),
                                                TextEntry::make('profile_visits_24h')->label('Visitas al perfil')->color('gray'),
                                                TextEntry::make('follows_24h')->label('Seguidores')->color('gray'),
                                                TextEntry::make('likes_24h')->label('Me gusta')->color('gray'),
                                                TextEntry::make('comments_24h')->label('Comentarios')->color('gray'),
                                                TextEntry::make('shares_24h')->label('Compartidos')->color('gray'),
                                                TextEntry::make('saves_24h')->label('Guardados')->color('gray'),
                                                TextEntry::make('reposts_24h')->label('Reposts')->color('gray'),
                                            ])
                                            ->columns(2),

                                        Tab::make('Fase de validación (3d)')
                                            ->schema([
                                                TextEntry::make('views_3d')->label('Vistas')->color('gray'),
                                                TextEntry::make('profile_visits_3d')->label('Visitas al perfil')->color('gray'),
                                                TextEntry::make('follows_3d')->label('Seguidores')->color('gray'),
                                                TextEntry::make('likes_3d')->label('Me gusta')->color('gray'),
                                                TextEntry::make('comments_3d')->label('Comentarios')->color('gray'),
                                                TextEntry::make('shares_3d')->label('Compartidos')->color('gray'),
                                                TextEntry::make('saves_3d')->label('Guardados')->color('gray'),
                                                TextEntry::make('reposts_3d')->label('Reposts')->color('gray'),
                                            ])
                                            ->columns(2),
                                        
                                        Tab::make('Rendimiento final (7d)')
                                            ->schema([
                                                TextEntry::make('views_7d')->label('Vistas')->color('gray'),
                                                TextEntry::make('profile_visits_7d')->label('Visitas al perfil')->color('gray'),
                                                TextEntry::make('follows_7d')->label('Seguidores')->color('gray'),
                                                TextEntry::make('likes_7d')->label('Me gusta')->color('gray'),
                                                TextEntry::make('comments_7d')->label('Comentarios')->color('gray'),
                                                TextEntry::make('shares_7d')->label('Compartidos')->color('gray'),
                                                TextEntry::make('saves_7d')->label('Guardados')->color('gray'),
                                                TextEntry::make('reposts_7d')->label('Reposts')->color('gray'),
                                            ])
                                            ->columns(2)
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columns(3)
                            ->contained(false),

                        Section::make('Métricas calculadas')
                            ->schema([
                                TextEntry::make('view_to_profile_conversion_rate')
                                    ->label('Vistas → Perfil')
                                    ->color('gray')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('profile_visit_to_follow_conversion_rate')
                                    ->label('Perfil → Seguidores')
                                    ->color('gray')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('likes_engagement_rate')
                                    ->label('Me gusta')
                                    ->color('gray')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('saves_engagement_rate')
                                    ->label('Guardados')
                                    ->color('gray')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('comments_engagement_rate')
                                    ->label('Comentarios')
                                    ->color('gray')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('shares_engagement_rate')
                                    ->label('Compartidos')
                                    ->color('gray')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('reposts_engagement_rate')
                                    ->label('Reposts')
                                    ->color('gray')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('total_engagement_rate')
                                    ->label('Interacciones (total)')
                                    ->color('gray')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),
                            ])
                            ->columns(2),
                    ]),

                EditAction::make(),
            ])
            ->recordAction(ViewAction::class)
            ->recordUrl(null)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}