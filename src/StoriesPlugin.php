<?php

declare(strict_types=1);

namespace Mortezaa97\Stories;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Mortezaa97\Reviews\Filament;
use Mortezaa97\Stories\Filament\Resources\Stories\StoryResource;

class StoriesPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'stories';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                'StoryResource' => StoryResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
