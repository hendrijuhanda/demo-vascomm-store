<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles and assign to users
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        User::all()->each(function ($user, $index) {
            $user->assignRole($index === 0 ? 'admin' : 'user');
        });
    }
}
