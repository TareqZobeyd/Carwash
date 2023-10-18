<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        $user = User::query()->create([
            'name' => 'tareq',
            'email' => 'tareq@gmail.com',
            'phone' => '09168900083',
            'password' => '123456'
        ]);
        $role = Role::findByName('super-admin');
        $user->assignRole($role);
    }
}
