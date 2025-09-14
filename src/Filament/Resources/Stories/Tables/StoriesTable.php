<?php

declare(strict_types=1);

namespace Mortezaa97\Stories\Filament\Resources\Stories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class StoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \App\Filament\Components\Table\TitleTextColumn::create(),
                \App\Filament\Components\Table\SlugTextColumn::create(),
                \Filament\Tables\Columns\TextColumn::make('description')->searchable(),
                \App\Filament\Components\Table\CoverImageColumn::create(),
                \App\Filament\Components\Table\ImageImageColumn::create(),
                \Filament\Tables\Columns\TextColumn::make('video')->searchable(),
                \App\Filament\Components\Table\UrlTextColumn::create(),
                \App\Filament\Components\Table\UserTextColumn::create(),
                \App\Filament\Components\Table\ParentTextColumn::create(),
                \App\Filament\Components\Table\StatusTextColumn::create(Story::class),
                \App\Filament\Components\Table\CreatedByTextColumn::create(),
                \App\Filament\Components\Table\UpdatedByTextColumn::create(),
                \App\Filament\Components\Table\DeletedAtTextColumn::create(),
                \App\Filament\Components\Table\CreatedAtTextColumn::create(),
                \App\Filament\Components\Table\UpdatedAtTextColumn::create(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
