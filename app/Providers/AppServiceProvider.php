<?php

namespace App\Providers;

use App\Store;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('store', function ($app) {
            return app(Store::class);
        });
    }
}
