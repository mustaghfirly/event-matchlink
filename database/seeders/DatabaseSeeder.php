<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@eventmatchlink.com',
            'phone'    => '081111111111',
            'role'     => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name'     => 'Panitia',
            'email'    => 'panitia@eventmatchlink.com',
            'phone'    => '082222222222',
            'role'     => 'panitia',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name'     => 'Perusahaan',
            'email'    => 'perusahaan@eventmatchlink.com',
            'phone'    => '083333333333',
            'role'     => 'perusahaan',
            'password' => bcrypt('password'),
        ]);
    }
}
