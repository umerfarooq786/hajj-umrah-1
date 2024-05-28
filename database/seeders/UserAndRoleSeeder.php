<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a user
        $user = User::create([
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'image' => '',
        ]);

        $role = Role::create([
            'name' => 'Admin',
        ]);

        $permissions = [
            'roles-list',
            'roles-create',
            'roles-edit',
            'roles-delete',
            'routes-list',
            'routes-create',
            'routes-edit',
            'routes-delete',
            'users-list',
            'users-create',
            'users-edit',
            'users-delete',
            'transports-list',
            'transports-create',
            'transports-edit',
            'transports-delete',
            'vehicles-list',
            'vehicles-create',
            'vehicles-edit',
            'vehicles-delete',
            'hotels-list',
            'hotels-create',
            'hotels-edit',
            'hotels-delete',
            'packages-list',
            'packages-create',
            'packages-edit',
            'packages-delete',
            'tours-list',
            'tours-create',
            'tours-edit',
            'tours-delete',
            'add-weekends-days',
            'packages-calculation',
            'currencys-conversion',
            'contacts-view',
            'contacts-delete',
            'visa-charges',
        ];
        $role->syncPermissions($permissions);
        // Assign a role to the user
        $role = Role::where('name', 'Admin')->first();
        if ($role) {
            $user->assignRole($role);
        }
    }
}
