<?php

namespace App\Providers;

use App\Models\Log;
use App\Services\QueueControllerService;
use App\Services\QueueControllerServiceInterface;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Queue;
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
        Queue::looping(function () {
           $fp = fopen('/var/www/app/qq.txt', 'w');
           fwrite($fp, 'r');
           fclose($fp);
        });
    }
}
