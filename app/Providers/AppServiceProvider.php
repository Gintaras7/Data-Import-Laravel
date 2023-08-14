<?php

namespace App\Providers;

use App\Clients\OpenSenseMap\OpenSenseMapClient;
use App\Contracts\SensorClientContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SensorClientContract::class, OpenSenseMapClient::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
