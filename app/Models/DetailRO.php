<?php

namespace App\Models;

use App\Models\RO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailRO extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function ro(): BelongsTo
    {
        return $this->belongsTo(RO::class, 'r_o_id');
    }
    
    public function supplier_barang(): BelongsTo
    {
        return $this->belongsTo(SupplierBarang::class, 'supplier_barang_id');
    }
}
