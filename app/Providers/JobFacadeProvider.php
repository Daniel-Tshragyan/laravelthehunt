<?php

namespace App\Providers;

use App\Service\JobService;
use Illuminate\Support\ServiceProvider;

class JobFacadeProvider extends ServiceProvider
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
        $this->app->singleton('jobfacade', function () {
            return new JobService();
        });
    }
}
