<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
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
            'kode' => 'TR-' . sprintf('%07d', $count++),
            'user_id' => User::all()->random()->id,
            'nama_pembeli' => fake()->name(),
            'metode_pembayaran' => fake()->randomElement(['Kredit', 'Debit', 'Cash', 'E-Wallet']),
            'agen_pengiriman' => fake()->randomElement(['JNE', 'J&T', 'Lion Parcel', 'AnterAja']),
            'harga_pengiriman' => fake()->numberBetween(10000,999999),
            'total' => fake()->numberBetween(10000,99999999),
            'created_at' => fake()->dateTimeBetween('-2 week','')->format('Y-m-d H:i:s'),
        ];
    }
}
