<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $count = 1;
        return [
            'username' => 'USR' . sprintf('%03d', $count++),
            'nama' => fake()->name(),
            'alamat' => fake()->address(),
            'telp' => fake()->phoneNumber(),
            'password' => bcrypt('password')
        ];
    }
}
