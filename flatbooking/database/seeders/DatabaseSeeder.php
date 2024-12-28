<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'phone' => '01774581267',
            'email' => 'test3@example.com',
            'designation' => 'Manager',
            'password'=> '123456789',
        ]);

        // Permission Create
        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'show']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'delete']);

        Permission::create(['name' => 'view role', 'guard_name' => 'web',]);
        Permission::create(['name' => 'create role', 'guard_name' => 'web',]);
        Permission::create(['name' => 'update role', 'guard_name' => 'web',]);
        Permission::create(['name' => 'delete role', 'guard_name' => 'web',]);

        Permission::create(['name' => 'view permission', 'guard_name' => 'web',]);
        Permission::create(['name' => 'create permission', 'guard_name' => 'web',]);
        Permission::create(['name' => 'update permission', 'guard_name' => 'web',]);
        Permission::create(['name' => 'delete permission', 'guard_name' => 'web',]);

        Permission::create(['name' => 'view user', 'guard_name' => 'web',]);
        Permission::create(['name' => 'create user', 'guard_name' => 'web',]);
        Permission::create(['name' => 'update user', 'guard_name' => 'web',]);
        Permission::create(['name' => 'delete user', 'guard_name' => 'web',]);

        Permission::create(['name' => 'view project', 'guard_name' => 'web',]);
        Permission::create(['name' => 'create project', 'guard_name' => 'web',]);
        Permission::create(['name' => 'update project', 'guard_name' => 'web',]);
        Permission::create(['name' => 'view project', 'guard_name' => 'web',]);
        Permission::create(['name' => 'delete project', 'guard_name' => 'web',]);

        Permission::create(['name' => 'login project', 'guard_name' => 'web',]);
        Permission::create(['name' => 'logout project', 'guard_name' => 'web',]);

        Permission::create(['name' => 'view investment', 'guard_name' => 'web',]);
        Permission::create(['name' => 'create investment', 'guard_name' => 'web',]);
        Permission::create(['name' => 'show investment', 'guard_name' => 'web',]);

        Permission::create(['name' => 'installment', 'guard_name' => 'web',]);

        Permission::create(['name' => 'view expanse', 'guard_name' => 'web',]);
        Permission::create(['name' => 'create expanse', 'guard_name' => 'web',]);
        Permission::create(['name' => 'update expanse', 'guard_name' => 'web',]);
        Permission::create(['name' => 'show expanse', 'guard_name' => 'web',]);

        Permission::create(['name' => 'list purchase', 'guard_name' => 'web',]);
        Permission::create(['name' => 'create purchase', 'guard_name' => 'web',]);
        Permission::create(['name' => 'show purchase', 'guard_name' => 'web',]);

        Permission::create(['name' => 'list return purchase', 'guard_name' => 'web',]);
        Permission::create(['name' => 'create return purchase', 'guard_name' => 'web',]);
        Permission::create(['name' => 'show return purchase', 'guard_name' => 'web',]);

        Permission::create(['name' => 'list flat', 'guard_name' => 'web',]);
        Permission::create(['name' => 'add flat', 'guard_name' => 'web',]);
        Permission::create(['name' => 'update flat', 'guard_name' => 'web',]);
        Permission::create(['name' => 'flat view', 'guard_name' => 'web',]);
        Permission::create(['name' => 'flat delete', 'guard_name' => 'web',]);

        Permission::create(['name' => 'flat sale', 'guard_name' => 'web',]);

        Permission::create(['name' => 'flat return', 'guard_name' => 'web',]);
        Permission::create(['name' => 'flat return list', 'guard_name' => 'web',]);

        Permission::create(['name' => 'project report', 'guard_name' => 'web',]);

        Permission::create(['name' => 'list client', 'guard_name' => 'web',]);
        Permission::create(['name' => 'create client', 'guard_name' => 'web',]);
        Permission::create(['name' => 'delete client', 'guard_name' => 'web',]);

        Permission::create(['name' => 'list employee', 'guard_name' => 'web',]);
        Permission::create(['name' => 'create employee', 'guard_name' => 'web',]);
        Permission::create(['name' => 'delete employee', 'guard_name' => 'web',]);

        Permission::create(['name' => 'list vendor', 'guard_name' => 'web',]);
        Permission::create(['name' => 'create vendor', 'guard_name' => 'web',]);
        Permission::create(['name' => 'delete vendor', 'guard_name' => 'web',]);


    }
}
