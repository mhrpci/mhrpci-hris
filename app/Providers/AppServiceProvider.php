<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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

        // Monitor notification performance
        \DB::listen(function($query) {
            if (str_contains($query->sql, 'notifications')) {
                \Log::debug('Notification Query', [
                    'time' => $query->time,
                    'sql' => $query->sql
                ]);
            }
        });

        if (config('app.env') === 'local') {
            URL::forceScheme('http');
        } else {
            URL::forceScheme('https');
        }
    }
}
