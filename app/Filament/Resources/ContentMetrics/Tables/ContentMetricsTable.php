<?php

namespace App\Filament\Resources\ContentMetrics\Tables;

use App\Filament\Resources\ContentMetrics\Pages\ViewContentMetric;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContentMetricsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),

                TextColumn::make('type')
                    ->searchable(),

                TextColumn::make('format')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->modalHeading('Content Metric Details')
                    ->modalWidth('5xl')
                    ->modalFooterActions([
                        Action::make('edit')
                            ->label('Edit')
                            ->icon('heroicon-o-pencil')
                            ->url(fn ($record) => route(
                                'filament.admin.resources.content-metrics.edit',
                                $record
                            )),
                    ])
                    ->schema([
                        Section::make('Post Data')
                            ->schema([
                                TextEntry::make('title'),
                                TextEntry::make('type'),
                                TextEntry::make('accounts_reached'),
                                TextEntry::make('profile_visits'),
                                TextEntry::make('follows'),
                                TextEntry::make('likes'),
                                TextEntry::make('comments'),
                                TextEntry::make('shares'),
                                TextEntry::make('saves'),
                                TextEntry::make('reposts'),
                                TextEntry::make('views'),
                            ])
                            ->columns(2),

                        Section::make('Calculated Metrics')
                            ->schema([
                                TextEntry::make('reach_to_profile_conversion_rate')
                                    ->label('Reach → Profile')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('profile_to_follow_conversion_rate')
                                    ->label('Profile → Follow')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('likes_engagement_rate')
                                    ->label('Likes Engagement')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('saves_engagement_rate')
                                    ->label('Saves Engagement')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('comments_engagement_rate')
                                    ->label('Comments Engagement')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('shares_engagement_rate')
                                    ->label('Shares Engagement')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('reposts_engagement_rate')
                                    ->label('Reposts Engagement')
                                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2) . '%'),

                                TextEntry::make('total_engagement_rate')
                                    ->label('Total Engagement')
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