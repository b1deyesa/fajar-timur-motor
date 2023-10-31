<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            User::create([
                'username' => 'USR001',
                'nama' => 'Chelsie',
                'password' => bcrypt('12345678'),
            ]);
            

            User::create([
                'username' => 'USR002',
                'nama' => 'Tiffany',
                'password' => bcrypt('12345678'),
            ]);

            User::create([
                'username' => 'USR003',
                'nama' => 'Kenry',
                'password' => bcrypt('12345678'),
            ]);

            User::create([
                'username' => 'USR004',
                'nama' => 'Imagodeo',
                'password' => bcrypt('12345678'),
            ]);
    }
}
