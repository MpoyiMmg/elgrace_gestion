<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'name' => 'Location ventes',
                'code' => 'LCV'
            ], 
            [
                'name' => 'Licences',
                'code' => 'LIC'
            ], 
            [
                'name' => 'Cleaning',
                'code' => 'CLN'
            ]
        ];

        foreach ($modules as $module) {
            Module::factory()->create([
                'name' => $module['name'],
                'code' => $module['code']
            ]);
        }
    }
}
