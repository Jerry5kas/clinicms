<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('theme', [
                'primary' => config('theme.primary_color'),
                'secondary' => config('theme.secondary_color'),
                'accent' => config('theme.accent_color'),
            ]);
        });
    }

}
