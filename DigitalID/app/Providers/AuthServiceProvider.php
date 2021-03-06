<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("isOfficial", function ($user){
            return $user->role == "admin" || $user->role ==  "official";
        });

        Gate::define("isUser", function ($user){
            return $user->role == "admin" || $user->role ==  "official" || $user->role ==  "user";
        });

        Gate::define("is", function ($user){
            return $user->role == "admin" || $user->role ==  "official" || $user->role ==  "user";
        });
        Passport::routes();

        Passport::tokensExpireIn(now()->addDays(5));

        Passport::refreshTokensExpireIn(now()->addDays(10));
    }
}
