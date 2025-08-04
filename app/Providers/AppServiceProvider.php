<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SystemTheme;
use Illuminate\Support\Facades\View;


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
    public function boot()
    {
        View::composer(['layouts.app', 'auth.login'], function ($view) {
            $latest = SystemTheme::latest()->first();
            $view->with('latest', $latest);
        });
    }
}
