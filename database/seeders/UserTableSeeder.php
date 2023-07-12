<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //create data user
         $userCreate = User::create([
            'nama'      => 'Admin',
            'username'  => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('password')
        ]);

        //assign permission to role
        $role = Role::where('id', 1)->first();;
        
        $permissions = Permission::all();

        $role->syncPermissions($permissions);

        //assign role with permission to user
        $user = User::find(1);
        $user->assignRole($role->name);

        $role = Role::where('name', 'Admin')->first();
        $user = User::where(['email' => 'admin@admin.com', 'password' => 'password'])->first();
        $user->assignRole($role);
    }

}
