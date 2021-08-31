<?php

namespace App\Providers;

use App\Service\MessageService;
use Illuminate\Support\ServiceProvider;

class MessageProvider extends ServiceProvider
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
        $this->app->singleton('messagefacade', function () {
            return new MessageService();
        });

    }
}
