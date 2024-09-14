<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //permissions
        $permissions = [
            'manage categories',
            'manage packages',
            'manage transactions',
            'manage package banks',
            'checkout package',
            'view orders',
        ];

        foreach ($permissions as $item) {
            Permission::firstOrCreate([
                'name' => $item,
            ]);
        }

        $customerRole = Role::firstOrCreate([
            'name' => 'customer',
        ]);

        $customerPermissions = [
            'checkout package',
            'view orders',
        ];

        $customerRole->syncPermissions($customerPermissions);

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
        ]);

        // $superAdminPermissions = [
        //     '',
        // ];

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('@Bismillah12'),
            'avatar' => 'images/default-avatar.png',
            'phone_number' => '085800288265',
        ]);

        $user->assignRole($superAdminRole);

    }
}
