<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_r_o_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('r_o_id')->constrained('r_o_s')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('supplier_barang_id')->constrained('supplier_barangs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['Selesai', 'Dalam Proses', 'Dibatalkan'])->default('Dalam Proses');
            $table->string('stok_diminta')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_r_o_s');
    }
};
