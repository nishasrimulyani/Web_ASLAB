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
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => ('12345678'),
        ]);

        $admin->assignRole('admin');

        $panitia = User::create([
            'name' => 'Panitia',
            'email' => 'panitia@gmail.com',
            'password' => ('12345678'),
        ]);

        $panitia->assignRole('panitia');

        $peserta = User::create([
            'name' => 'Peserta',
            'email' => 'peserta@gmail.com',
            'password' => ('12345678'),
        ]);

        $peserta->assignRole('peserta');
    }

}
