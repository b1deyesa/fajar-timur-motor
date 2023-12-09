<?php

namespace App\Models;

use App\Models\User;
use App\Models\Barang;
use App\Models\SupplierBarang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequisitionOrder extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function supplier_barang(): BelongsTo
    {
        return $this->belongsTo(SupplierBarang::class, 'supplier_barang_id');
    }
}
