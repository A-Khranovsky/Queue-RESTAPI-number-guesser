<?php

namespace App\Providers;

use App\Services\QueueControllerServiceInterface;
use App\Services\QueueFuncJobControllerService;
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
        $this->app->singleton(QueueControllerServiceInterface::class, function () {
            return new QueueFuncJobControllerService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
