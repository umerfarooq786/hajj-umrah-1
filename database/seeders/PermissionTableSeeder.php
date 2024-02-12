<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'route-list',
           'route-create',
           'route-edit',
           'route-delete',
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
           'package-list',
           'package-create',
           'package-edit',
           'package-delete',
           'add-weekend-days',
           'package-calculation',
           'currency-conversion'
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}