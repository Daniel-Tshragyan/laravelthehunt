<?php

namespace App\Providers;

use App\Service\PlanService;
use Illuminate\Support\ServiceProvider;

class PlanProvider extends ServiceProvider
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
        $this->app->singleton('planfacade', function () {
            return new PlanService();
        });
    }
}
