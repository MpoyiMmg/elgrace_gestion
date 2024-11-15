<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserByRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Manager user
        $role = Role::where('name', 'manager')->first();
        $user = User::factory()->create([
            'email' => 'manager@elg-s.com',
            'password' => '123456789'
        ]);
        $user->assignRole($role);

        // Cashier user
        $role = Role::where('name', 'cashier')->first();
        $user = User::factory()->create([
            'email' => 'cashier@elg-s.com',
            'password' => '123456789'
        ]);
        $user->assignRole($role);
    }
}
