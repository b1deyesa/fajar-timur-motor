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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->char('kode', 9)->unique();
            $table->foreignId('gudang_id')->constrained('gudangs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('merek')->nullable();
            $table->string('harga_beli')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
