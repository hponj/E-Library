<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                'name' => 'Admin',
                'username' => 'GwAdmin',
                'email'=> 'mdj.faheem6@gmail.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'User',
                'username' => 'GwUser',
                'email'=> 'jUy5y@example.com',
                'password' => bcrypt('user123'),
                'role' => 'user',
            ]
        ]);
    }
}
