<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Property;
use App\Models\User;
use App\Models\Role;
use App\Models\PurchaseOffer;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::define('isAdmin', function(User $user) {
            
            return $user->role_id == '3';
         
        });

        Gate::define('isBroker', function(User $user) {
            
            return $user->role_id == '2';
         
        });

        Gate::define('isCustomer', function(User $user) {
            
            return $user->role_id == '1';
         
        });



        /*
        Gate::define('edit-property', function (User $user, Property $property) {
            return $user->user_id === $property->user_id;
        });
        */

    }
}
