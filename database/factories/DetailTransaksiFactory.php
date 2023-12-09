<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailTransaksi>
 */
class DetailTransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaksi_id' => Transaksi::all()->random()->id,
            'barang_id' => Barang::all()->random()->id,
            'jumlah' => fake()->numberBetween(1,50),
            'harga_jual' => fake()->numberBetween(10000,99999999),
            'satuan' => fake()->randomElement(['pcs', 'set']),
        ];
    }
}
