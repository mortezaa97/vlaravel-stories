<?php

declare(strict_types=1);

namespace Mortezaa97\Stories\Filament\Resources\Stories;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mortezaa97\Stories\Filament\Resources\Stories\Pages\CreateStory;
use Mortezaa97\Stories\Filament\Resources\Stories\Pages\EditStory;
use Mortezaa97\Stories\Filament\Resources\Stories\Pages\ListStories;
use Mortezaa97\Stories\Filament\Resources\Stories\Schemas\StoryForm;
use Mortezaa97\Stories\Filament\Resources\Stories\Tables\StoriesTable;
use Mortezaa97\Stories\Models\Story;

class StoryResource extends Resource
{
    protected static ?string $model = Story::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'story';

    public static function form(Schema $schema): Schema
    {
        return StoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStories::route('/'),
            'create' => CreateStory::route('/create'),
            'edit' => EditStory::route('/{record}/edit'),
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
