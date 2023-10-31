<?php

namespace App\Models;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class,'barang_id');
    }
}
