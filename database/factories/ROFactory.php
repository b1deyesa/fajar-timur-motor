<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RO>
 */
class ROFactory extends Factory
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
            'kode' => 'RO-' . sprintf('%05d', $count++),
            'user_id' => User::all()->random()->id,
            'supplier_id' => Supplier::all()->random()->id
        ];
    }
}
