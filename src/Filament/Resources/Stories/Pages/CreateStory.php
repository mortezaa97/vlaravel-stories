<?php

declare(strict_types=1);

namespace Mortezaa97\Stories\Filament\Resources\Stories\Pages;

use Filament\Resources\Pages\CreateRecord;
use Mortezaa97\Stories\Filament\Resources\Stories\StoryResource;

class CreateStory extends CreateRecord
{
    protected static string $resource = StoryResource::class;
}
