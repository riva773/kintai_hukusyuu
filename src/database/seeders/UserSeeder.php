<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'is_admin' => false,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'admin_user',
                'email' => 'admin@gmail.com',
                'is_admin' => true,
                'password' => bcrypt('password'),
            ],
        ]);
    }
}
