<?php

namespace App\Providers;

use App\Models\User;
use App\Enums\Permission;
use Illuminate\Support\Facades\Gate;
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
        //only managers allowed
        Gate::define(Permission::MANAGE_STATUSES->value, function (User $user) {
            return $user->role === 'manager';
        });
    }


}
