<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
    'code',
    'type',
    'target_id',
    'discount_percent',
    'expired_at',
    // 'is_active' <--- HAPUS ATAU KOMENTARI BARIS INI
];
    // Opsional: Jika kamu ingin memastikan 'code' selalu tersimpan dalam huruf kapital
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }
   public function users()
{
    // Tambahkan 'promo_users' sebagai parameter kedua
    return $this->belongsToMany(User::class, 'promo_users');
}
}