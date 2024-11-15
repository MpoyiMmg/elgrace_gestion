<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        Role::factory()->create([
            'name' => 'manager',
            'guard_name' => 'web'
        ]);

        Role::factory()->create([
            'name' => 'cashier',
            'guard_name' => 'web'
        ]);

        $role = Role::where('name', 'admin')->first();
        $permissions = Permission::all();

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        $user = User::where('email', 'admin@elg-s.com')->first();
        $user->assignRole($role);
    }
}
