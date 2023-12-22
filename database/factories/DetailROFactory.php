<?php

namespace Database\Factories;

use App\Models\RO;
use App\Models\SupplierBarang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailRO>
 */
class DetailROFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'r_o_id' => RO::all()->random()->id,
            'supplier_barang_id' => SupplierBarang::all()->random()->id,
            'status' => fake()->randomElement(['Dalam Proses', 'Selesai', 'Dibatalkan']),
            'stok_diminta' => rand(10, 100)
        ];
    }
}
