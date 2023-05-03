<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Temporal\Client\GRPC\ServiceClient;
use Temporal\Client\WorkflowClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(WorkflowClient::class, function (Application $app) {
            return WorkflowClient::create(ServiceClient::create(config('services.temporal.domain')));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
