<?php

namespace App\Providers;

use App\Service\CategoryService;
use Illuminate\Support\ServiceProvider;

class CategoryFacadeProvider extends ServiceProvider
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
        $this->app->singleton('categoryfacade', function () {
            return new CategoryService();
        });
    }
}
