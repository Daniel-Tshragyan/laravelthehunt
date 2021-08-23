<?php

namespace App\Providers;

use App\Service\CityService;
use Illuminate\Support\ServiceProvider;

class CityFacadeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('cityfacade', function () {
            return new CityService();
        });
    }
}
