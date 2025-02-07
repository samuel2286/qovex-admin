<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $arrayOfPermissionNames = [
            'view-TestResults','create-TestResult','edit-TestResult','destroy-TestResult',
            'view-appointments','create-appointment','edit-appointment','destroy-appointment',
            'view-TestOffers','create-TestOffer','edit-TestOffer','destroy-TestOffer',
            'view-authentication','view-settings',
            'view-users','create-user','edit-user','destroy-user',
            'view-roles','create-role','edit-role','destroy-role',
            'view-permissions','create-permission','edit-permission','destroy-permission',
        ];
        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());

        $admin = Role::create(['name' => 'super-admin']);
        Role::create([
            'name' => 'patient',
        ]);
        $admin->givePermissionTo(Permission::all());
    }
}
