<?php

namespace App\Providers;

use App\Models\Foods;
use Illuminate\Support\ServiceProvider;

class FoodsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register the Foods class in the service container.
        $this->app->singleton(Foods::class, function ($app) {
            return new Foods;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
