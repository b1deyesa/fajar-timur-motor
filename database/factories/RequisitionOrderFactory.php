<?php

namespace Database\Factories;

use App\Models\SupplierBarang;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequisitionOrder>
 */
class RequisitionOrderFactory extends Factory
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
            'kode' => 'REQ-' . sprintf('%05d', $count++),
            'user_id' => User::all()->random()->id,
            'supplier_barang_id' => SupplierBarang::all()->random()->id,
        ];
    }
}
