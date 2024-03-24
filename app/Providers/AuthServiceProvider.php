<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Route;
 

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        Passport::tokensCan([
            'read' => 'Read data',
            'write' => 'Write data',
            'delete' => 'Delete data',
        ]);
        
        $this->registerPolicies();   
       // Passport::routes();     
        Passport::tokensExpireIn(now()->addDays(15));

       // Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super admin') ? true : null;
        }); 
        

    }
}
