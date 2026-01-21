<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        // 1. Super Admin: If user has 'admin' role, allow everything
        // This is a "global" check that runs before any other gate
        Gate::before(function (User $user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });

        // 2. Define specific permissions (from your TP)
        // This uses the hasPermission helper you added to User.php earlier
        Gate::define('users.manage', function (User $user) {
            return $user->hasPermission('users.manage');
        });

        Gate::define('products.create', function (User $user) {
            return $user->hasPermission('products.create');
        });
        
        Gate::define('products.update', function (User $user) {
            return $user->hasPermission('products.update');
        });
    }
}
