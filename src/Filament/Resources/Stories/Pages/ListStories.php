<?php

declare(strict_types=1);

namespace Mortezaa97\Stories\Filament\Resources\Stories\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Mortezaa97\Stories\Filament\Resources\Stories\StoryResource;

class ListStories extends ListRecords
{
    protected static string $resource = StoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
