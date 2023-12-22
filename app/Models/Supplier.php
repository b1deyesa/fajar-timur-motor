<?php

namespace App\Models;

use App\Models\RO;
use App\Models\SupplierBarang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    
    public function supplier_barangs(): HasMany
    {
        return $this->hasMany(SupplierBarang::class);
    }

    public function ros(): HasMany
    {
        return $this->hasMany(RO::class);
    }
}
