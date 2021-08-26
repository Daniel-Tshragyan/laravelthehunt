<?php

namespace App\Providers;

use App\Service\UserService;
use Illuminate\Support\ServiceProvider;
use App\Facades\UserServiceHelper;

class UserServiceFacadeProvider extends ServiceProvider
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
        $this->app->singleton('userfacade', function () {
            return new UserService();
        });
    }
}
