<?php

namespace App\Models;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    
    public function supplier_barangs(): HasMany
    {
        return $this->hasMany(SupplierBarang::class);
    }
}
