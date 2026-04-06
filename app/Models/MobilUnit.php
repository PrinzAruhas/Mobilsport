<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MobilUnit extends Model
{
    protected $table = 'mobil_units';

    protected $fillable = [
        'mobil_id',
        'no_polisi',
        'warna',
        'foto_unit',
        'status'
    ];

    // Opsional, pastikan kolom ini memang ada di database
    protected $appends = ['foto_list'];

    public function mobil(): BelongsTo
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }

    public function getFotoListAttribute()
    {
        // Pengecekan lebih aman agar tidak error jika data bukan string
        if (empty($this->foto_unit)) {
            return [];
        }
        
        // Hanya lakukan explode jika memang ada tanda koma, 
        // jika hanya 1 file, kembalikan dalam array
        return strpos($this->foto_unit, ',') !== false 
            ? explode(',', $this->foto_unit) 
            : [$this->foto_unit];
    }
}