<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SupplierBarang>
 */
class SupplierBarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supplier_id' => Supplier::all()->random()->id,
            'barang_id' => Barang::all()->random()->id,
            'harga_beli' => fake()->numberBetween(1000,999999999),
            'stok' => fake()->numberBetween(0,100),
            'status' => fake()->randomElement(['Dalam Proses', 'Telah Dikirim', 'Dibatalkan'])
        ];
    }
}
