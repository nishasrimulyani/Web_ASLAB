<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //permission for exams
        Permission::create(['name' => 'ujians.index']);
        Permission::create(['name' => 'ujians.create']);
        Permission::create(['name' => 'ujians.edit']);
        Permission::create(['name' => 'ujians.delete']);

        //permission for subjects
        Permission::create(['name' => 'subjeks.index']);
        Permission::create(['name' => 'subjeks.create']);
        Permission::create(['name' => 'subjeks.edit']);
        Permission::create(['name' => 'subjeks.delete']);

        //permission for questions
        Permission::create(['name' => 'soals.index']);
        Permission::create(['name' => 'soals.create']);
        Permission::create(['name' => 'soals.edit']);
        Permission::create(['name' => 'soals.delete']);

         //permission for images
         Permission::create(['name' => 'gambars.index']);
         Permission::create(['name' => 'gambars.create']);
         Permission::create(['name' => 'gambars.delete']);

         //permission for documents
         Permission::create(['name' => 'docs.index']);
         Permission::create(['name' => 'dokumens.create']);
         Permission::create(['name' => 'dokumens.edit']);
         Permission::create(['name' => 'dokumens.delete']);

        //permission for roles
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.delete']);

        //permission for permissions
        Permission::create(['name' => 'permissions.index']);

        //permission for users
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);
    }
}
