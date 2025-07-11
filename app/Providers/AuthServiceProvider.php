<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Seus policies aqui, ex:
        // User::class => UserPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-access', function (User $user) {
            return $user->role_id == 1; // Admin
        });

        Gate::define('technician-access', function (User $user) {
            return $user->role_id == 2; // Técnico (exemplo)
        });

        Gate::define('user-access', function (User $user) {
            return $user->role_id == 3; // Usuário comum (exemplo)
        });
    }
}
