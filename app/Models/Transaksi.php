<?php

namespace App\Models;

use App\Models\User;
use App\Models\DetailTransaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Transaksi extends Model
{
    use HasFactory;
    use Searchable;
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

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'kode' => $this->kode,
            'nama_pembeli' => $this->nama_pemebeli
        ];
    }
}
