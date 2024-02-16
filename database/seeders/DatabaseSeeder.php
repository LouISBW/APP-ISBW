<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'SuperAdmin']);
        $permission = Permission::create(['name' => 'Delete User']);

        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $user= User::factory()->create([
                     'name' => 'Super Admin',
                     'email' => 'admin@isbw.be',
                 ]);

        $user->assignRole($role);
        User::factory(10)->create();
        $this->call(DepartmentSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(StatutSeeder::class);

    }
}
