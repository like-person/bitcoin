<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\ApiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\Services\ApiService', function ($app) {
          return new ApiService();
        });
    }
}
