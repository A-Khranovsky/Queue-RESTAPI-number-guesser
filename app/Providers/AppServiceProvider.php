<?php

namespace App\Providers;

use App\Events\FailedJobEvent;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
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

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Queue::failing(function ($connection, $job, $data) {
//            $fp = fopen('/var/www/app/qq.txt', 'w');
//            fwrite($fp, 'www');
//            fclose($fp);
//        });
    }
}
