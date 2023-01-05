<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        if (!app()->runningInConsole()) {
            $roles  = Role::with('permission')->get();
            foreach ($roles as $role) {
                foreach ($role->permission as $permission) {
                    $permissionArray[$permission->check_slug][] = $role->id;
                }
            }

            if (isset($permissionArray)) 
            {
                foreach ($permissionArray as $check_slug => $roles) {
                    Gate::define($check_slug, function (User $user) use ($roles) {
                        return count(array_intersect($user->role->pluck('id')->toArray(), $roles));
                    });
                }
            }
        }
    }
}
