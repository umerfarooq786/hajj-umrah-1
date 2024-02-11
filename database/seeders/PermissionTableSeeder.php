<?php

namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'transport-list',
           'transport-create',
           'transport-edit',
           'transport-delete',
           'hotel-list',
           'hotel-create',
           'hotel-edit',
           'hotel-delete',
           'add-weekend-days',
           'package-list',
           'package-create',
           'package-edit',
           'package-delete',
           'package-calculation',
           'currency-conversion',
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
