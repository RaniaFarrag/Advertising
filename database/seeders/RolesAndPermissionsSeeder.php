<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = ['manage tags', 'manage categories', 'filter ads','show ads'];
        foreach ($permissions as $permission){
            Permission::create(['name' => $permission]);
        }
        // Create Roles
        $admin_role = Role::create(['name'=>'Admin'])->givePermissionTo(Permission::all());
        $advertiser_role = Role::create(['name'=>'Advertiser'])->givePermissionTo(['filter ads', 'show ads']);

        // Create Users and assign its roles
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin@admin.com'),
        ]);
        $admin->assignRole($admin_role);

        $advertiser = User::create([
            'name' => 'Advertiser1',
            'email' => 'advertiser@advertiser.com',
            'password' => Hash::make('advertiser@advertiser.com'),
        ]);
        $advertiser->assignRole($advertiser_role);

        $advertiser = User::create([
            'name' => 'Advertiser2',
            'email' => 'advertiser2@advertiser2.com',
            'password' => Hash::make('advertiser2@advertiser2.com'),
        ]);
        $advertiser->assignRole($advertiser_role);

    }
}
