<?php

namespace App\Filament\Resources\Hypotheses;

use App\Filament\Resources\Hypotheses\Pages\CreateHypothesis;
use App\Filament\Resources\Hypotheses\Pages\EditHypothesis;
use App\Filament\Resources\Hypotheses\Pages\ListHypotheses;
use App\Filament\Resources\Hypotheses\RelationManagers\TestsRelationManager;
use App\Filament\Resources\Hypotheses\Schemas\HypothesisForm;
use App\Filament\Resources\Hypotheses\Schemas\HypothesisInfolist;
use App\Filament\Resources\Hypotheses\Tables\HypothesesTable;
use App\Models\Hypothesis;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HypothesisResource extends Resource
{
    protected static ?string $model = Hypothesis::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBeaker;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $modelLabel = 'Experimento';
    
    protected static ?string $pluralModelLabel = 'Experimentos';

    protected static ?int $navigationSort = 5;

    public function getTitle(): string
    {
        return 'Editar ' . $this->record->title;
    }

    public static function form(Schema $schema): Schema
    {
        return HypothesisForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HypothesisInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HypothesesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TestsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHypotheses::route('/'),
            'create' => CreateHypothesis::route('/create'),
            'edit' => EditHypothesis::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
