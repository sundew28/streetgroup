<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Managers\Parser\ParserManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('Parser', function ($app) {
            return new ParserManager($app);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
