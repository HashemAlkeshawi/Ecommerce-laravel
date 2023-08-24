<?php

namespace Modules\User\app\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Route::middleware('web')->group(function () {
            $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        });

        Route::middleware('api')->group(function () {

            $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        });
    }
}
