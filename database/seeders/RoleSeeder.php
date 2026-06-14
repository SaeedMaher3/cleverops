<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Full system access',
            'status' => 'active',
        ]);

        Role::create([
            'name' => 'manager',
            'display_name' => 'Manager',
            'description' => 'Department management access',
            'status' => 'active',
        ]);

        Role::create([
            'name' => 'staff',
            'display_name' => 'Staff',
            'description' => 'Basic employee access',
            'status' => 'active',
        ]);
    }
}