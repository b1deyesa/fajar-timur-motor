<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\RO;
use App\Models\Log;
use App\Models\User;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\DetailRO;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\SupplierBarang;
use App\Models\DetailTransaksi;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(GudangSeeder::class);
        
        // User::factory(1)->create();
        // Gudang::factory(2)->create();
        // Supplier::factory(5)->create();
        // Barang::factory(10)->create();
        // SupplierBarang::factory(100)->create();
        // RO::factory(15)->create();
        // DetailRO::factory(40)->create();
        // Transaksi::factory(50)->create();
        // DetailTransaksi::factory(200)->create();
        // Log::factory(100)->create();
    }
}
