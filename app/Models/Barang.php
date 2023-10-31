<?php

namespace App\Models;

use App\Models\Gudang;
use App\Models\Supplier;
use App\Models\DetailTransaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
    }

    public function detail_transaksis(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class);
    }
    
    public function supplier_barangs(): HasMany
    {
        return $this->hasMany(SupplierBarang::class);
    }
}
