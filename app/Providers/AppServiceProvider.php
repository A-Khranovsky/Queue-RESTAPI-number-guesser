<?php

namespace App\Providers;

use App\Services\QueueControllerService;
use App\Services\QueueControllerServiceInterface;
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
            return new QueueControllerService();
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
