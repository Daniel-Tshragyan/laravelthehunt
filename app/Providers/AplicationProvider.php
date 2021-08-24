<?php

namespace App\Providers;

use App\Service\ApplicationService;
use Illuminate\Support\ServiceProvider;

class AplicationProvider extends ServiceProvider
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
        $this->app->singleton('applicationfacade', function () {
            return new ApplicationService();
        });
    }
}
