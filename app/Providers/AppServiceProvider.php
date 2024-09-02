<?php

namespace App\Providers;

use App\Models\League;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        Route::bind('league', function (string $value) {
            return League::where('id', $value)->with('seasons')->firstOrFail();
        });
    }
}
