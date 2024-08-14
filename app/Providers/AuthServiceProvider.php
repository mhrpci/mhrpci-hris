<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Define your model to policy mappings here
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Add your authorization logic here
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        $this->registerPolicies();

        // Register Passport routes manually in routes/api.php instead
        $this->registerPassportRoutes();
    }

    /**
     * Register Passport routes.
     */
    protected function registerPassportRoutes()
    {
        // You can move this logic to routes/api.php as discussed earlier
        if (! $this->app->routesAreCached()) {
            Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
            Passport::tokensCan([
                'place-orders' => 'Place orders',
                'check-status' => 'Check order status',
            ]);
            Passport::setDefaultScope([
                'check-status',
            ]);
        }
    }
}
