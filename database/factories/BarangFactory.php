<?php

namespace Database\Factories;

use App\Models\Gudang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
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
            'kode' => 'BRG-' . sprintf('%05d', $count++),
            'gudang_id' => Gudang::all()->random()->id,
            'nama' => fake()->colorName(),
            'deskripsi' => fake()->text(100),
            'merek' => fake()->userAgent(),
        ];
    }
}
