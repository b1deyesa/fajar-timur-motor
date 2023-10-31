<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Log;
use App\Models\Transaksi;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;
    protected $fillable = [
        'username',
        'nama',
        'alamat',
        'telp',
        'password'
    ];
    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }
}
