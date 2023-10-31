<?php

namespace App\Models;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gudang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class);
    }
}
