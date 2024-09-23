<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'status' => true,
        ]);

        $adminRole = Role::create(['name' => 'Admin']);

        // Get all permissions and assign to the Admin role
        $permissions = Permission::all();
        $adminRole->syncPermissions($permissions);

        // Assign the Admin role to the admin user
        $adminUser->assignRole($adminRole);
    }
}
