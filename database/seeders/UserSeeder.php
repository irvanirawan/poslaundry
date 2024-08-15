<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add User
        $user = User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Sukses99'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // add permission
        $permissions = [
            'user.create',
            'user.read',
            'user.update',
            'user.delete',
            'role.create',
            'role.read',
            'role.update',
            'role.delete',
            'permission.create',
            'permission.read',
            'permission.update',
            'permission.delete',
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'name' => $permission,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // add role
        $roles = [
            'admin',
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // assign role to user
        $user->assignRole('admin');

        // assign permission to role admin the permissions from the permissions table in the database
        $permissions = DB::table('permissions')->get();
        $role = DB::table('roles')->where('name', 'admin')->first();

        foreach ($permissions as $permission) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => $permission->id,
                'role_id' => $role->id,
            ]);
        }
    }
}
