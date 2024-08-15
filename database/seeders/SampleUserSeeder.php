<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SampleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // insert sample user kasir
        $user = User::create([
            'name' => 'Kasir',
            'email' => 'kasir1@gmail.com',
            'password' => Hash::make('password'),
            'username' => 'kasir1',
        ]);

        // assign role kasir to user kasir
        $role = Role::create(['name' => 'kasir']);
        $user->assignRole($role);
    }
}
