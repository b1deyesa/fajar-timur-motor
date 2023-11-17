<?php

namespace App\Models;

use App\Models\User;
use App\Models\DetailTransaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detail_transaksis(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function sum()
    {        
        $hasil = 0;
        foreach ($this->detail_transaksis as $key => $value) {
            $hasil += $value['harga_jual'] * $value['jumlah'];
        }

        return $hasil;
    }
}
