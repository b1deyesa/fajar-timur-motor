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
                'username' => 'chelsie',
                'nama' => 'Chelsie',
                'password' => bcrypt('12345678'),
            ]);
            

            User::create([
                'username' => 'tiffany',
                'nama' => 'Tiffany',
                'password' => bcrypt('12345678'),
            ]);

            User::create([
                'username' => 'kenry',
                'nama' => 'Kenry',
                'password' => bcrypt('12345678'),
            ]);

            User::create([
                'username' => 'mago',
                'nama' => 'Imagodeo',
                'password' => bcrypt('12345678'),
            ]);
    }
}
