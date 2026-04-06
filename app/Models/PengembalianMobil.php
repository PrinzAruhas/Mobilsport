<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengembalianMobil extends Model
{
    protected $table = 'pengembalian_mobils';

    protected $fillable = [
        'sewa_id',
        'user_id',
        'mobil_id',
        'bukti_kartu',
        'kondisi',
        'laporan'
    ];

    /**
     * Relasi ke user (penyewa)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke mobil
     */
    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }

    /**
     * Relasi ke transaksi sewa
     */
    public function sewa()
    {
        return $this->belongsTo(Sewa::class, 'sewa_id');
    }
}