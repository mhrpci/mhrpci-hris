<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Pagination\Paginator;

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
        // Paginator::useBootstrapFive();

        // Monitor notification performance
        \DB::listen(function($query) {
            if (str_contains($query->sql, 'notifications')) {
                \Log::debug('Notification Query', [
                    'time' => $query->time,
                    'sql' => $query->sql
                ]);
            }
        });
    }
}
