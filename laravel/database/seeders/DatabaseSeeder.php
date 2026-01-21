<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // 1. Create Roles
        $adminRole = \App\Models\Role::firstOrCreate(['name' => 'admin']);
        $managerRole = \App\Models\Role::firstOrCreate(['name' => 'manager']);
        $staffRole = \App\Models\Role::firstOrCreate(['name' => 'staff']);

        // 2. Create Permissions
        $manageUsers = \App\Models\Permission::firstOrCreate(['name' => 'users.manage']);
        $createProd = \App\Models\Permission::firstOrCreate(['name' => 'products.create']);

        // Assign Permissions to Roles
        $adminRole->permissions()->syncWithoutDetaching([$manageUsers->id, $createProd->id]);
        $managerRole->permissions()->syncWithoutDetaching([$createProd->id]);

        // 3. Create Admin User
        $adminUser = \App\Models\User::firstOrCreate(
            ['email' => 'admin@test.com'],
            ['name' => 'Admin User', 'password' => bcrypt('password')]
        );
        $adminUser->roles()->syncWithoutDetaching([$adminRole->id]);

        // 4. Create Manager User
        $managerUser = \App\Models\User::firstOrCreate(
            ['email' => 'manager@test.com'],
            ['name' => 'Manager User', 'password' => bcrypt('password')]
        );
        $managerUser->roles()->syncWithoutDetaching([$managerRole->id]);
        
        // 5. Create Staff User
        $staffUser = \App\Models\User::firstOrCreate(
            ['email' => 'staff@test.com'],
            ['name' => 'Staff User', 'password' => bcrypt('password')]
        );
        $staffUser->roles()->syncWithoutDetaching([$staffRole->id]);
    }
}
