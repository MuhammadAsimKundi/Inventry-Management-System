<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Call additional seeders
        $this->call([
            CustomerSeeder::class,
            OrderSeeder::class,
        ]);

        // Create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $staffRole = Role::create(['name' => 'Staff']);

        // Create permissions
        Permission::create(['name' => 'manage products']);
        Permission::create(['name' => 'manage customers']);
        Permission::create(['name' => 'manage orders']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(['manage products', 'manage customers', 'manage orders']);
        $staffRole->givePermissionTo(['manage products', 'manage customers']);

        // Assign roles to users
        // Assuming the first user is the admin and the second user is staff
        $admin = User::find(1);
        $staff = User::find(2);

        if ($admin) {
            $admin->assignRole('Admin');
        }

        if ($staff) {
            $staff->assignRole('Staff');
        }
    }
}
