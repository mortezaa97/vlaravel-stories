<?php

declare(strict_types=1);

namespace Mortezaa97\Stories;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Mortezaa97\Stories\Filament\Resources\Stories\StoryResource;
use Mortezaa97\Stories\Models\Story;
use Mortezaa97\Stories\Policies\StoryPolicy;

class StoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap package services.
     */
    public function boot(): void
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        // Register policies
        Gate::policy(Story::class, StoryPolicy::class);
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('stories.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'migrations');
        }
    }

    /**
     * Register package services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'stories');

        $this->app->singleton('stories', function () {
            return new Stories;
        });
    }
}
