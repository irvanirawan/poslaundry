<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get list folders in Modules
        $modules = scandir(base_path('Modules'));
        $modules = array_diff($modules, ['.', '..']);

        // add permission for each module in Modules folder in Laravel
        foreach ($modules as $module) {
            $module = ucfirst($module);
            $permissions = [
                strtolower($module).'.create',
                strtolower($module).'.read',
                strtolower($module).'.update',
                strtolower($module).'.delete',
            ];

            foreach ($permissions as $permission) {
                DB::table('permissions')->insert([
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
