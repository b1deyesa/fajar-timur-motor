<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gudang>
 */
class GudangFactory extends Factory
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
            'kode' => 'GDG-' . sprintf('%03d', $count++),
            'nama' => fake()->name(),
            'alamat' => fake()->streetAddress(),
            'kapasitas' => fake()->numberBetween(100,999),
        ];
    }
}
