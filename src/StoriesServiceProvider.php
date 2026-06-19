<?php

declare(strict_types=1);

namespace Mortezaa97\Stories;

use Mortezaa97\Stories\Concerns\PublishesPackageAssets;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Mortezaa97\Stories\Models\Story;
use Mortezaa97\Stories\Policies\StoryPolicy;

class StoriesServiceProvider extends ServiceProvider
{
    use PublishesPackageAssets;

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

            $this->publishPackageAssets('stories');
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
