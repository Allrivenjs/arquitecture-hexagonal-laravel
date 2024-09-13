<?php

namespace App\Providers;

use Core\Shared\Domain\UuidGenerator;
use Core\Shared\Infrastructure\RamseyUuidGenerator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class BoundedContextProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UuidGenerator::class,
            RamseyUuidGenerator::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /**
         * Load the routes for the Course Bounded Context.
         */
        $this->loadMigrationsFrom(
            File::allFiles(base_path('src/BoundedContext/**/Infrastructure/migrations'))
        );
    }
}
