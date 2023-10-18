<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'super-admin'
        ]);

        DB::table('permissions')->insert([
            [
                'name' => 'view users'
            ],
            [
                'name' => 'create users'
            ],
            [
                'name' => 'edit users'
            ],
            [
                'name' => 'delete users'
            ],
            [
                'name' => 'view reservations'
            ],
            [
                'name' => 'create reservations'
            ],
            [
                'name' => 'edit reservations'
            ],
            [
                'name' => 'delete reservations'
            ]
        ]);

        Role::query()->first()->syncPermissions(Permission::all());
    }
}
