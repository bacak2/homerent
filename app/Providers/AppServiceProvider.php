<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'production') {
            \Debugbar::disable();
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         if (env('APP_ENV') === 'production') {
            $this->app['url']->forceScheme('https');
         }
    }
}
