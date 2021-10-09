<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Permission;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {    
        $this->registerPolicies();

        Gate::before(function (User $user, $ability) {
        
            $user_role = $user->with('roles')->find($user->id);
            foreach ($user_role->roles as $role) {
                if ($role->name == 'Administrador') {
                    return true;
                }
            }
        });

        $permissions = Permission::with('roles')->get();

        foreach ($permissions as $permission) {

            Gate::define($permission->name, function (User $user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }
    }
}
