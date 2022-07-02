<?php

namespace App\Providers;

use App\Infrastructure\Http\QSymfonySkeletonApiHttpClient;
use App\Infrastructure\Http\QSymfonySkeletonApiInterface;
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
        $this->app->bind(
            QSymfonySkeletonApiInterface::class,
            QSymfonySkeletonApiHttpClient::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
