<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mobil extends Model
{
    protected $fillable = [
        'merek', 
        'model', 
        'harga_sewa', 
        'deskripsi', 
        'gambar', 
        'video',
        'category_id',
        'kapasitas',
        'transmisi', 
        'bahan_bakarnya',
        'diskon',
        'expired_at',
    ];

    /**
     * Relasi ke Unit Armada
     */
    public function units(): HasMany
    {
        return $this->hasMany(MobilUnit::class, 'mobil_id');
    }

    /**
     * Relasi ke Kategori
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Aksesor untuk stok (Total Unit Keseluruhan)
     * Panggil dengan: $mobil->stock
     */
    public function getStockAttribute(): int
    {
        return $this->units()->count();
    }

    /**
     * Aksesor untuk stok yang tersedia saja (untuk peminjam)
     * Panggil dengan: $mobil->stok_tersedia
     */
    public function getStokTersediaAttribute(): int
    {
        return $this->units()->where('status', 'tersedia')->count();
    }
    public function comments() {
    return $this->hasMany(Comment::class)->whereNull('parent_id')->with('replies');
}
}