<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
    public function boot()
    {
        // Role::create(['name' => 'client']);
        // Role::create(['name' => 'admin']);

        // Permission::create(['name' => 'submit industrial visit request']);
        // Permission::create(['name' => 'manage industrial visit requests']);

        // $clientRole = Role::findByName('client');
        // $adminRole = Role::findByName('admin');

        // $clientRole->givePermissionTo('submit industrial visit request');
        // $adminRole->givePermissionTo('manage industrial visit requests');
    }
}
